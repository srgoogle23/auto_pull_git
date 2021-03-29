<?php

namespace AutoGitPuller\Server;


class BaseRepository {
    protected $id;
    protected $name;
    protected $owner;
    protected $html_url;
    protected $git_url;

    function __construct($args = array())
    {
        $default = array(
            "id" => "",
            "name" => "",
            "owner" => "",
            "html_url"=> "",
            "git_url" =>""
        );
        $args = array_merge($default, $args);
        $this->id = $args["id"];
        $this->name = $args["name"];
        $this->owner = $args["owner"];
        $this->git_url = $args["git_url"];
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param mixed $owner
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
    }

    /**
     * @return mixed
     */
    public function getHtmlUrl()
    {
        return $this->html_url;
    }

    /**
     * @param mixed $html_url
     */
    public function setHtmlUrl($html_url)
    {
        $this->html_url = $html_url;
    }

    /**
     * @return mixed
     */
    public function getGitUrl()
    {
        return $this->git_url;
    }

    /**
     * @param mixed $git_url
     */
    public function setGitUrl($git_url)
    {
        $this->git_url = $git_url;
    }
}
