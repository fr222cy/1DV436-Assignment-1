<?php


class Mailinfo
{
    
    private $location;
    private $message;
    
    public function __construct($location, $message)
    {
        $this->location = $location;
        $this->message = $message;

    }
    
    public function getSnippet()
    {
        
        $snippetString = "<p>". $this->message->snippet ."...</p>";
        
        return $snippetString;
    }
    
    public function getCoordsToJS()
    {
        
    }
    
    public function getSubject()
    {
       $subjectString = "<p>". $this->message->getPayLoad()->getHeaders()[16]->value ."</p>";
       
       return $subjectString;
    }
    
    public function getMailRecived()
    {
        $senderString = "<p> Mail Retrieved: ". $this->message->getPayLoad()->getHeaders()[14]->value ."</p>";
        
        return $senderString;
    }
    
    
    
}