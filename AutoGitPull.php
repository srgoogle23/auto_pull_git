<?php

/**
 * Project : simple-php-git-deploy
 * User: thuytien
 * Date: 11/10/2014
 * Time: 12:15 AM
 */

namespace AutoGitPuller;

use AutoGitPuller\Util\Error;
use AutoGitPuller\Util\Logger;

class AutoGitPull
{

    /**
     * @param mixed $isEmailOn \AutoGitPuller\Util\Error
     */
    protected $secretKey;
    protected $branchMap; //map branch to directory
    protected $authorMap; //map author to directory
    protected $exclude;
    protected $tmpDir;
    protected $targetDir;
    protected $isNeedClearUp;
    protected $backupDir;
    protected $isUseComposer;
    protected $emailOnError;
    protected $notifyEmail;
    protected $log;
    protected $isTryMkDir;
    protected $composerOptions;
    protected $commander;
    protected $repositoryName;
    protected $canDeleteFile;
    protected $isNeedVersionFile;
    protected $username;
    protected $password;
    protected $event;
    protected $shh;

    function __construct($args = array())
    {
        Logger::logStart();
        $this->ssh = \AutoGitPuller\Util\SSH::getInstance();
        //init properties
        $this->init($args);

        $handlerResult = $this->handleRequest();

        if ($handlerResult instanceof \AutoGitPuller\Util\Error) {
            echo $handlerResult->getMessage();
        }
        else {
            $this->commander = \AutoGitPuller\Util\Commander::getInstance();
            $checkResult = $this->checkEnvironment();
            if ($checkResult instanceof \AutoGitPuller\Util\Error) {
                echo $checkResult->getMessage();
            }
            else
            {
                $pullResult = $this->doPull();
            }
        }
        Logger::logEnd();
    }

    protected function init($args = array())
    {
        $this->secretKey = $args["secretKey"];
        $this->repositoryName = $args["repository"];
        $this->branchMap = $args["branchMap"];
        $this->authorMap = $args["authorMap"];
        $this->exclude = $args["exclude"];
        $this->tmpDir = $args["tmpDir"];
        $this->targetDir = $args["targetDir"];
        $this->canDeleteFile = $args["canDeleteFile"];
        $this->isNeedClearUp = $args["isNeedClearUp"];
        $this->backupDir = $args["backupDir"];
        $this->isUseComposer = $args["isUseComposer"];
        $this->emailOnError = $args["emailOnError"];
        $this->isNeedVersionFile = $args["isNeedVersionFile"];
        $this->isTryMkDir = $args["isTryMkDir"];
        $this->username = $args["username"];
        $this->password = $args["password"];
        $this->composerOptions = $args['composerOptions'];

        $args_keys = array_keys($args);
        foreach ($args_keys as $key):
            if(strpos($key, 'ssh') !== false):
                $this->ssh->__set($key, $args[$key]);
            endif;
        endforeach;
    }

    public function checkEnvironment()
    {
        $result = array(
            "error" => false
        );
        if ($this->isTryMkDir) {
            //try to make dir

            if (($this->backupDir !== '') && (!$this->ssh->ssh_is_dir($this->backupDir))) {
                $this->commander->execute(sprintf('mkdir -p %1$s', $this->backupDir));
            }
            if (($this->tmpDir !== '') && (!$this->ssh->ssh_is_dir($this->tmpDir))) {
                $this->commander->execute(sprintf('mkdir -p %1$s', $this->tmpDir));  
            }
            if (($this->targetDir !== '') && (!$this->ssh->ssh_is_dir($this->targetDir))) {
                $this->commander->execute(sprintf('mkdir -p %1$s', $this->targetDir));
            }

            //try to create dir
            foreach ($this->branchMap as $branch => $dir) {
                $targetDir = $this->targetDir . $dir;
                if (($dir !== '') && !$this->ssh->ssh_is_dir($dir)) {
                    $this->commander->execute(sprintf('mkdir -p %1$s', $dir));
                }
                foreach ($this->authorMap as $author => $authorDir) {
                    $authorDirPath = $targetDir . $authorDir;
                    if (($authorDirPath !== '') && !$this->ssh->ssh_is_dir($authorDirPath)) {
                        $this->commander->execute(sprintf('mkdir -p %1$s', $authorDirPath));
                    }
                }
            }
        }
        //Check if dir exist and write able
        foreach ($this->branchMap as $branch => $dir) {
            $targetDir = $this->targetDir . $dir;
            if (!$this->ssh->ssh_is_dir($targetDir) || !$this->ssh->ssh_is_writable($targetDir)) {
                return new \AutoGitPuller\Util\Error("", sprintf('Branch dir:  <code>`%s`</code> does not exists or is not writeable.', $targetDir));
            }
            foreach ($this->authorMap as $author => $authorDir) {
                $authorDirPath = $targetDir . $authorDir;
                if (($authorDirPath !== '') && !$this->ssh->ssh_is_dir($authorDirPath)) {
                    return new Error("", sprintf('Author dir:  <code>`%s`</code> does not exists or is not writeable.', $dir));
                }
            }
        }
        //check backup dir
        if (($this->backupDir != '') && (!$this->ssh->ssh_is_dir($this->backupDir) || !$this->ssh->ssh_is_writable($this->backupDir))) {
            return new \AutoGitPuller\Util\Error("", sprintf('Backup <code>`%s`</code> does not exists or is not writeable.', $this->backupDir));
        }
        //Check tmp dir
        if (($this->tmpDir != '') && (!$this->ssh->ssh_is_dir($this->tmpDir) || !$this->ssh->ssh_is_writable($this->tmpDir))) {
            return new \AutoGitPuller\Util\Error("", sprintf('Temp dir <code>`%s`</code> does not exists or is not writeable.', $this->tmpDir));
        }
        if (($this->targetDir != '') && (!$this->ssh->ssh_is_dir($this->targetDir) || !$this->ssh->ssh_is_writable($this->targetDir))) {
            return new \AutoGitPuller\Util\Error("", sprintf('Target dir <code>`%s`</code> does not exists or is not writeable.', $this->targetDir));
        }
        //check directory
        if ($this->commander->execute("which git") == '') {
            return new \AutoGitPuller\Util\Error("", "GIT is not installed.");
        }
        //only use rsync when have tmp dir
        if ($this->tmpDir !== '') {
            if ($this->commander->execute("which rsync") == '') {
                return new \AutoGitPuller\Util\Error("", "rsync is not installed.");
            }
        }
        //only user tar when backup
        if ($this->backupDir !== '') {
            if ($this->commander->execute("which tar") == '') {
                return new \AutoGitPuller\Util\Error("", "tar is not installed.");
            }
        }
        //only use composer when...
        if ($this->isUseComposer) {
            if ($this->commander->execute("which composer --no-ansi") == '') {
                return new \AutoGitPuller\Util\Error("", "composer is not installed.");
            }
        }
    }

    //handle and processing postdata from git
    public function handleRequest()
    {
        $headerString = "";
        if( isset($_SERVER['HTTP_X_GITHUB_DELIVERY'])) {
            $this->event = new \AutoGitPuller\Server\Github\Event($this->secretKey, $this->username, $this->password);
        }
        else{
            $this->event = new \AutoGitPuller\Server\Bitbuck\Event($this->secretKey, $this->username, $this->password);
        }

        $isValidatedRequest = $this->event->processRequest();

        if ($isValidatedRequest instanceof \AutoGitPuller\Util\Error) {
            return $isValidatedRequest;
        }
        //check if commiter id is map with dir
        if ( array_key_exists($this->event->getCommiterUsername(), $this->authorMap) ) {
            if ( array_key_exists($this->event->getRepositoryBranch(), $this->branchMap) ) {
                return true;
            } else {
                return new Error("", "Branch is not allowed");
            }
        } else {
            return new Error("", "This commiter is not allowed");
        }
    }

    //build git command
    private function doPull()
    {
        $branchName = $this->event->getRepositoryBranch();
        $committer = $this->event->getCommiterUsername();
        $gitURL = $this->event->getRepositoryGitURL();
        $tmpDir = $this->tmpDir;
        $isUsersync = false;
        $repositoryDir = sprintf('%1$s%2$s', $this->branchMap[$branchName], $this->authorMap[$committer]);

        //Check if use rsync
        if ($tmpDir !== '') //rsync
        {
            $isUsersync = true;
            $targetDir = $tmpDir . $repositoryDir;
        } else //not use rsync
        {
            $targetDir = $this->targetDir . $repositoryDir;
        }
        //check if need backup
        if ( ($this->backupDir !== '') && ($this->ssh->ssh_is_dir($targetDir))) {
            $this->doBackup($this->backupDir, $targetDir);
        }

        //check if git init on target dir
        if ($this->ssh->ssh_is_dir($targetDir . "/.git")) {
            $this->doFetch($branchName, $targetDir);
        } else {
            $this->doClone($gitURL, $targetDir, $branchName);
        }
        if($this->isUseComposer)
        {
            $this->doComposer($targetDir);
        }
        if($isUsersync)
        {
            $this->doRSYNC($targetDir, $this->targetDir . $repositoryDir);
            if($this->isNeedClearUp){
                $this->doCleanUp($tmpDir);
            }
        }
        $this->commander->execute();
    }

    private function doClone($gitURL, $targetDir, $branchName)
    {
        //clean directory
        $this->commander->enqueue(sprintf(
            'rm -rf %1$s/*'
            , $targetDir
        ));
        $this->commander->enqueue(sprintf(
            'git clone --depth=1 --branch %1$s %2$s %3$s'
            , $branchName
            , $gitURL
            , $targetDir
        ));
    }
    private function doFetch($branchName, $targetDir)
    {
        $this->commander->enqueue(sprintf(
            'git fetch origin %1$s'
            , $branchName
        ));
        $this->commander->enqueue('git reset --hard FETCH_HEAD');

        /*$this->commander->enqueue(sprintf(
            'cd %1$s'
            , $targetDir
        ));*/

        $this->commander->enqueue(sprintf(
            'git submodule update --init --recursive'
        ));
    }

    private function doBackup($backupDir, $targetDir)
    {
        if (count(glob($targetDir."/*")) !== 0 ) { //Check if target dir is not empty
            $this->commander->enqueue(sprintf(
                "tar --exclude='%s*' -czf %s/%s-%s-%s.tar.gz %s*"
                , $backupDir
                , $backupDir
                , basename($targetDir)
                , md5($targetDir)
                , date('YmdHis')
                , $targetDir // We're backing up this directory into BACKUP_DIR
            ));
        }
    }
    private function doComposer($targetDir){
        $this->commander->enqueue(sprintf(
            'composer --no-ansi --no-interaction --no-progress --working-dir=%s install %s'
            , $targetDir
            , $this->composerOptions
        ));
    }
    private function doRSYNC($source, $dest){
        $exclude = '';
        foreach($this->exclude as $exc)
        {
            $exclude .= ' --exclude=' . $exc;
        }
        $this->commander->enqueue(sprintf(
            'rsync -rltgoDzvO %1$s %2$s %3$s %4$s'
            , $source
            , $dest
            , ($this->canDeleteFile) ? '--delete-after' : ''
            , $exclude
        ));
    }
    private function doCleanUp($dir)
    {
        $this->commander->enqueue(sprintf(
            'rm -rf %s'
            , $dir
        ));
    }
}