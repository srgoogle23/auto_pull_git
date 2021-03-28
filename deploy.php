<?php
require_once 'config.php';
if (!isset($_GET['sat']) || $_GET['sat'] !== SECRET_ACCESS_TOKEN) {
    header('HTTP/1.0 403 Forbidden');
}
ob_start();
if (!isset($_GET['sat']) || $_GET['sat'] !== SECRET_ACCESS_TOKEN) {
    die('<h2>ACCESS DENIED!</h2>');
}
?>


Checking the environment ...

Running as <b><?php echo whoami(); ?></b>.

    <?php

    $requiredBinaries = array('git', 'rsync');
    foreach ($requiredBinaries as $command) {
        $command_linne = 'which ' . $command;
        $path = trim(checkrequiredBinaries($command_linne));
        if ($path == '') {
            die(sprintf('<div class="error"><b>%s</b> not available. It needs to be installed on the server for this script to work.</div>', $command));
        } else {
            $command_linne = $command . ' --version';
            $version = explode("\n", checkVersion($command_linne));
            printf('<b>%s</b> : %s' . "\n"
                , $path
                , $version[0]
            );
        }
    }
    ?>

    Environment OK.

Deploying <?php echo REMOTE_REPOSITORY; ?> <?php echo BRANCH . "\n"; ?>
    
    <?php


    $results = gitPull();
    $results_arr= explode(PHP_EOL, $results);
    foreach($results_arr as $result_arr){
        echo $result_arr . '<br/>';
    }

    ?>

    Done.

</body>
</html>

<?php
function checkrequiredBinaries($command_linne){
    $connection = ssh2_connect(HOST, PORT);
    ssh2_auth_password($connection, USERNAME, PASSWORD);
  
    $stream = ssh2_exec($connection, $command_linne);
    stream_set_blocking($stream,true);
    $cmd = stream_get_contents($stream);
    $arr=explode("\n",$cmd);
    if(count($arr) != 0){
        $content = false;
        foreach($arr as $row){
            if($row != '' or $row != null or $row != false){
                $content = true;
                $value = $row;
            }
        }
        if($content != true){
            return '';
        }else{
            return $value;
        }
    }else{
        return '';
    }

}

function whoami(){
    $connection = ssh2_connect(HOST, PORT);
    ssh2_auth_password($connection, USERNAME, PASSWORD);
  
    $stream = ssh2_exec($connection, 'whoami');
    stream_set_blocking($stream,true);
    $cmd = stream_get_contents($stream);
    $arr=explode("\n",$cmd);
    if(count($arr) != 0){
        foreach ($arr as $row){
            if($row != '' or $row != null or $row != false){
                return $row;
            }
        }
    }else{
        return "error";
    }
}

function checkVersion($command_linne){
    $connection = ssh2_connect(HOST, PORT);
    ssh2_auth_password($connection, USERNAME, PASSWORD);
  
    $stream = ssh2_exec($connection, $command_linne);
    stream_set_blocking($stream,true);
    $cmd = stream_get_contents($stream);
    $arr=explode("\n",$cmd);
    if(count($arr) != 0){
        foreach ($arr as $row){
            if($row != '' or $row != null or $row != false){
                return $row;
            }
        }
    }else{
        return "error";
    }
}
function gitPull(){
    $connection = ssh2_connect(HOST, PORT);
    ssh2_auth_password($connection, USERNAME, PASSWORD);
    $command_linne = 'cd ' . PATH . ' && git pull --force';
    $stream = ssh2_exec($connection, $command_linne);
    stream_set_blocking($stream,true);
    $cmd = stream_get_contents($stream);
    $arr=explode("\n",$cmd);
    if(count($arr) != 0){
        $content = false;
        $value = '';
        foreach ($arr as $row){
            if($row != '' or $row != null or $row != false){
                $content = true;
                $value .= $row . '
                ';
            }
            if($content != true){
                return 'error';
            }else{
                return $value;
            }
        }
    }else{
        return "error";
    }

}
?>