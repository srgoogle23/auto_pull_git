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
        $conn   = ssh2_connect( $this->__get('ssh_host'), $this->__get('ssh_port') );
        $auth   = ssh2_auth_pubkey_file( $conn, $this->__get('ssh_user'), $this->__get('ssh_public_key_dir'), $this->__get('ssh_private_key_dir'), $this->__get('ssh_password') );
        $command_formated = $command;
        $stream = ssh2_exec($conn, $command_formated);
        stream_set_blocking($stream,true);
        $cmd = stream_get_contents($stream);
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
        fclose($stream);
        $this->output[$command_formated] = $this->__get('last_command_results');
        return $this->__get('last_command_results');
    }

    public function ssh_exec($command){
        $this->__set( 'last_command_results', true );
        $conn   = ssh2_connect( $this->__get('ssh_host'), $this->__get('ssh_port') );
        $auth   = ssh2_auth_pubkey_file( $conn, $this->__get('ssh_user'), $this->__get('ssh_public_key_dir'), $this->__get('ssh_private_key_dir'), $this->__get('ssh_password') );
        $command_formated = 'cd ' . $this->__get('ssh_repository_dir') . '&& '. $command;
        $stream = ssh2_exec($conn, $command_formated);
        stream_set_blocking($stream,true);
        $cmd = stream_get_contents($stream);
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
        fclose($stream);
        $this->output[$command_formated] = $this->__get('last_command_results');
        return $this->__get('last_command_results');
    }

    public function ssh_is_dir($targetDir){
        $this->__set( 'last_command_results', 'vazio' );
        $conn   = ssh2_connect( $this->__get('ssh_host'), $this->__get('ssh_port') );
        $auth   = ssh2_auth_pubkey_file( $conn, $this->__get('ssh_user'), $this->__get('ssh_public_key_dir'), $this->__get('ssh_private_key_dir'), $this->__get('ssh_password') );
        $command_formated = '[ -d "'.$targetDir.'" ] && echo "true" || echo "false"';
        $stream = ssh2_exec($conn, $command_formated);
        stream_set_blocking($stream,true);
        $cmd = stream_get_contents($stream);
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
        fclose($stream);
        $this->output[$command_formated] = $this->__get('last_command_results');
        return filter_var( $this->__get('last_command_results'), FILTER_VALIDATE_BOOLEAN);
    }

    public function ssh_is_writable($targetDir){
        $this->__set( 'last_command_results', 'vazio' );
        $conn   = ssh2_connect( $this->__get('ssh_host'), $this->__get('ssh_port') );
        $auth   = ssh2_auth_pubkey_file( $conn, $this->__get('ssh_user'), $this->__get('ssh_public_key_dir'), $this->__get('ssh_private_key_dir'), $this->__get('ssh_password') );
        $command_formated = '[ -w "'.$targetDir.'" ] && echo "true" || echo "false"';
        $stream = ssh2_exec($conn, $command_formated);
        stream_set_blocking($stream,true);
        $cmd = stream_get_contents($stream);
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
        fclose($stream);
        $this->output[$command_formated] = $this->__get('last_command_results');
        return filter_var( $this->__get('last_command_results'), FILTER_VALIDATE_BOOLEAN);
    }
    

    public function ssh_mk_dir($command){
        $this->__set( 'last_command_results', true );
        $conn   = ssh2_connect( $this->__get('ssh_host'), $this->__get('ssh_port') );
        $auth   = ssh2_auth_pubkey_file( $conn, $this->__get('ssh_user'), $this->__get('ssh_public_key_dir'), $this->__get('ssh_private_key_dir'), $this->__get('ssh_password') );
        $command_formated = $command;
        $stream = ssh2_exec($conn, $command_formated);
        stream_set_blocking($stream,true);
        $cmd = stream_get_contents($stream);
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
        fclose($stream);
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