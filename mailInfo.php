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
        
        $snippetString = "'". $this->message->snippet ."...<br>'";
        
        return $snippetString;
    }
    
    public function getLocation()
    {
        return "'".$this->location."'";
    }
    
    public function getSubject()
    {
       // I use substr in this case to trim "FRW:"
       $subjectString = "'<h3>". substr($this->message->getPayLoad()->getHeaders()[16]->value ."<h3>'", 4);
       
       return $subjectString;
    }
    
    public function getMailRecived()
    {
        $senderString = "<p> Mail Retrieved: ". $this->message->getPayLoad()->getHeaders()[14]->value ."</p>";
        
        return $senderString;
    }
    
    
    
}