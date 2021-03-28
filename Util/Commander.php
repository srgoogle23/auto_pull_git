<?php

namespace AutoGitPuller\Util;

class Commander{
    protected $commands; //array
    protected $output = array();
    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new static();
        }

        return $instance;
    }

    /**
     * @param String $command
     */
    public function enqueue($command){
        $this->commands[] = $command;
    }
    public function checkRequirements(){}

    public function execute($command = ''){
        $SSH = \AutoGitPuller\Util\SSH::getInstance();
        if($command != '')
        {
            $this->output[$command] = $SSH->ssh_exec($command);
            return $this->output[$command];
        }
        else {
            if(count($this->commands) == 0)
            {
                return new Error("","Command is empty");
            }
            else {
                $result = "";
                foreach ($this->commands as $command) {
                    $tmp = array();
                    $this->output[$command] = $SSH->ssh_exec($command);
                    printf('<div class="command-row"><span class="prompt">$</span> <span class="command">%s</span><div class="output">%s</div></div>'
                        , htmlentities(trim($command))
                        , htmlentities(trim(implode("\n", $tmp)))
                    );
                }
                $this->commands = array();
            }
        }
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