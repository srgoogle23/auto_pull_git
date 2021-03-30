<?php
define("PARENT_DIR", dirname(__FILE__));

require_once "Util/Commander.php";
require_once "Util/Error.php";
require_once "Util/Logger.php";
require_once "Util/SSH.php";
require_once "Server/BaseEvent.php";
require_once "Server/Github/Event.php";
require_once "Server/Bitbucket/Event.php";
require_once "AutoGitPull.php";

use AutoGitPuller\AutoGitPull;
// remodelar auto git pull para funcionar em servidor (branchMap e authorMap) alterados inline
$default = array(
    "secretKey" => '',
    "repository"=>'https://github.com/srgoogle23/PHP-Git-Auto-Pull.git',
    "branchMap" => array(
        "master" =>"",
    ),
    "authorMap" =>array(
        "srgoogle23"=>"",
        "web-flow"=>"",
    ),
    "exclude" => array(),
    "targetDir" => '/home/ecomstore/PHP-Git-Auto-Pull/',
    "tmpDir" => '/home/ecomstore/PHP-Git-Auto-Pull/tmp/',
    "isNeedClearUp" => true,
    "backupDir" => '/home/ecomstore/PHP-Git-Auto-Pull/backup/',
    "isUseComposer" => false,
    "isTryMkDir" => true,
    "notifyEmail" => "leooli.teixeira@gmail.com",
    "emailOnError" => "leooli.teixeira@gmail.com",
    "username" => 'srgoogle23',
    'password' => '100499mm',
    "canDeleteFile" => true,
    'isNeedVersionFile' => true,
    'composerOptions' => '--no-dev',
    "ssh_host" => '144.217.192.219',
    "ssh_port" => 22,
    "ssh_public_key_dir" => "C:\wamp\www\auto_pull_git-main\srgoogle23.pub",
    "ssh_private_key_dir" => "C:\wamp\www\auto_pull_git-main\srgoogle23",
    "ssh_user" => "ecomstore",
    "ssh_password" => "100499Mm@@__",
    "ssh_repository_dir" => "./PHP-Git-Auto-Pull",
);


$args = array();
$args = array_merge($default, $args);
$autoGitPull = new AutoGitPull($args);