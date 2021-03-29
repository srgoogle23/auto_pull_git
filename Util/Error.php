<?php

namespace AutoGitPuller\Util;


class Error {
    protected $id;
    protected $message;

    function __construct($id, $message)
    {
        $this->id = $id;
        $this->message = $message;
    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

}
