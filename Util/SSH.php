<?php

namespace AutoGitPuller\Util;

class SSH{
    protected $ssh_host;
    protected $ssh_port;
    protected $ssh_public_key_dir;
    protected $ssh_private_key_dir;
    protected $ssh_user;
    protected $ssh_password;
    protected $ssh_repository_dir;
    protected $last_command_results;
    protected $output = array();
    public $conn;
    public $auth;
    public $stream;
    protected $verify_connection = true;

    public function set_instance(){
        if($this->__get('verify_connection')){
            $this->conn   = ssh2_connect( $this->__get('ssh_host'), $this->__get('ssh_port') );
            $this->auth   = ssh2_auth_pubkey_file( $this->conn, $this->__get('ssh_user'), $this->__get('ssh_public_key_dir'), $this->__get('ssh_private_key_dir'), $this->__get('ssh_password') );
            $this->__set('verify_connection',false);
        }
    }

    public function __destruct()
    {
        fclose($this->stream);
    }

    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new static();
        }

        return $instance;
    }


    public function __get( $variable ){
        if( !empty($this->$variable) ){
            $get_variable = $this->$variable;
        }

        return $get_variable;
    }

    public function __set( $variable, $target ){
        $this->$variable = $target;
    }

    public function ssh_exec_eq($command){
        $this->__set( 'last_command_results', true );
        $command_formated = $command;
        $this->stream = ssh2_exec($this->conn, $command_formated);
        stream_set_blocking($this->stream,true);
        $cmd = stream_get_contents($this->stream);
        $arr=explode("\n",$cmd);
        foreach($arr as $row):
            if($row != '' and $row != null and $row != false):
                $history  = $this->__get('last_command_results');
                if($history != true):
                    $history .= $row . '
';
                else:
                    $history = $row . '
';
                endif;
                $this->__set( 'last_command_results', $history );
            endif;
        endforeach;
        $this->output[$command_formated] = $this->__get('last_command_results');
        return $this->__get('last_command_results');
    }

    public function ssh_exec($command){
        $this->__set( 'last_command_results', true );
        $command_formated = 'cd ' . $this->__get('ssh_repository_dir') . '&& '. $command;
        $this->stream = ssh2_exec($this->conn, $command_formated);
        stream_set_blocking($this->stream,true);
        $cmd = stream_get_contents($this->stream);
        $arr=explode("\n",$cmd);
        foreach($arr as $row):
            if($row != '' and $row != null and $row != false):
                $history  = $this->__get('last_command_results');
                if($history != true):
                    $history .= $row . '
';
                else:
                    $history = $row . '
';
                endif;
                $this->__set( 'last_command_results', $history );
            endif;
        endforeach;
        $this->output[$command_formated] = $this->__get('last_command_results');
        return $this->__get('last_command_results');
    }

    public function ssh_is_dir($targetDir){
        $this->__set( 'last_command_results', 'vazio' );
        $command_formated = '[ -d "'.$targetDir.'" ] && echo "true" || echo "false"';
        $this->stream = ssh2_exec($this->conn, $command_formated);
        stream_set_blocking($this->stream,true);
        $cmd = stream_get_contents($this->stream);
        $arr=explode("\n",$cmd);
        foreach($arr as $row):
            if($row != '' and $row != null and $row != false):
                $history  = $this->__get('last_command_results');
                if($history != 'vazio'):
                    $history .= $row;
                else:
                    $history = $row;
                endif;
                $this->__set( 'last_command_results', $history );
            endif;
        endforeach;
        $this->output[$command_formated] = $this->__get('last_command_results');
        return filter_var( $this->__get('last_command_results'), FILTER_VALIDATE_BOOLEAN);
    }

    public function ssh_is_writable($targetDir){
        $this->__set( 'last_command_results', 'vazio' );
        $command_formated = '[ -w "'.$targetDir.'" ] && echo "true" || echo "false"';
        $this->stream = ssh2_exec($this->conn, $command_formated);
        stream_set_blocking($this->stream,true);
        $cmd = stream_get_contents($this->stream);
        $arr=explode("\n",$cmd);
        foreach($arr as $row):
            if($row != '' and $row != null and $row != false):
                $history  = $this->__get('last_command_results');
                if($history != 'vazio'):
                    $history .= $row;
                else:
                    $history = $row;
                endif;
                $this->__set( 'last_command_results', $history );
            endif;
        endforeach;
        $this->output[$command_formated] = $this->__get('last_command_results');
        return filter_var( $this->__get('last_command_results'), FILTER_VALIDATE_BOOLEAN);
    }
    

    public function ssh_mk_dir($command){
        $this->__set( 'last_command_results', true );
        $command_formated = $command;
        $this->stream = ssh2_exec($this->conn, $command_formated);
        stream_set_blocking($this->stream,true);
        $cmd = stream_get_contents($this->stream);
        $arr=explode("\n",$cmd);
        foreach($arr as $row):
            if($row != '' and $row != null and $row != false):
                $history  = $this->__get('last_command_results');
                if($history != true):
                    $history .= $row . '
';
                else:
                    $history = $row . '
';
                endif;
                $this->__set( 'last_command_results', $history );
            endif;
        endforeach;
        $this->output[$command_formated] = $this->__get('last_command_results');
        return $this->__get('last_command_results');
    }

    public function getOutput(){
        $html = "<div class='console_result'>";
        foreach($this->output as $command => $result)
        {
            $html .= sprintf('<p><span class="command">%1$s</span> : <span class="result">%2$s</span></p>', $command, $result);
        }
        return $html;
    }

}