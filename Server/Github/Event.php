<?php

namespace AutoGitPuller\Server\Github;

use AutoGitPuller\Server\BaseEvent;
use AutoGitPuller\Util\Error;

class Event extends BaseEvent{
    //https://developer.github.com/v3/activity/events/types/#pushevent
    function __construct($key='', $username='',$password='')
    {
        parent::__construct($key, $username, $password);
    }

    public function processRequest(){
       $headers = getallheaders();
       $hubSignature = $headers['X-Hub-Signature'];
       $payload = file_get_contents('php://input');
       $data = json_decode($payload);
       if($this->secretkey!=='') {
           list($algo, $hash) = explode('=', $hubSignature, 2);
           $payloadHash = hash_hmac($algo, $payload, $this->secretkey);
           if ($hash !== $payloadHash) {
               return new Error("","Secret key was not matched.");
           }
       }

       $this->repository = $data->repository;
       //get branch name from ref url
       $refParsed = explode('/',$data->ref);
       $this->repository->branchName = $refParsed[count($refParsed)-1];
       $this->author = $data->head_commit->committer;
       return true;
   }
    public function getCommiterUsername()
    {  
        return $this->author->username?$this->author->username:'';
    }
    public function getRepositoryName(){
        return $this->repository->name?$this->repository->name:'';
    }
    public function getRepositoryGitURL(){
        if( ($this->username !=='') && ( $this->password != '' ) ) {
            $gitURL = sprintf('https://%1$s:%2$s@github.com/%1$s/%3$s.git', $this->username, $this->password, $this->getRepositoryName());
        }
        else
        {
            $gitURL = $this->repository->clone_url;
        }
        return $gitURL;
    }
    public function getRepositoryBranch(){
        return $this->repository->branchName;
    }
}
