<?php

namespace AutoGitPuller\Server;

class BaseEvent
{
    protected $author; //the author, who maked event
    protected $repository;
    protected $secretkey;
    protected $username;
    protected $password;

    function __construct( $secretkey = '', $username = '', $password = '')
    {
        $this->secretkey = $secretkey;
        $this->username = $username;
        $this->password = $password;
    }

    public function processRequest()
    {
        return '';
    }

    /**
     * @return mixed
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param mixed $event
     */
    public function setEvent($event)
    {
        $this->event = $event;
    }

    /**
     * @return mixed
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * @param mixed $signature
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;
    }

    /**
     * @return mixed
     */
    public function getDelivery()
    {
        return $this->delivery;
    }

    /**
     * @param mixed $delivery
     */
    public function setDelivery($delivery)
    {
        $this->delivery = $delivery;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getRepository()
    {
        return $this->repository;
    }

    public function getCommiterUsername()
    {
        return '';
    }

    public function getRepositoryName()
    {
        return '';
    }

    public function getRepositoryBranch()
    {
        return '';
    }

    /**
     * @param mixed $repository
     */
    public function setRepository($repository)
    {
        $this->repository = $repository;
    }

}
