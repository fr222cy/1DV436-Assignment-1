<?php

require_once("mailInfo.php");

class Mail
{
    
    private $mails;
    
    public function getMails($client)
    {
        $this->mails = array();
        $service = new Google_Service_Gmail($client);
     
        var_dump($geocoding);
        $userId = 'me';
        
        $labelList = $service->users_labels->listUsersLabels($userId);

        if (count($labelList->getLabels()) < 1)
        {
          echo "No labels found.\n";
        } 
        
        else 
        {
            foreach ($labelList->getLabels() as $label) 
            {
                if (preg_match('/location/',$label->getName()))
                {
                    $messages = $service->users_messages->listUsersMessages($userId, array("includeSpamTrash" => false, "labelIds" => $label->id));
                    
                    $messages = $messages->getMessages();
                    
                    foreach($messages as $message)
                    {
                        $message = $service->users_messages->get($userId, $message->id, array("format" => "full"));
                        
                        //trim the first 9 characters "location/"
                        $location = substr($label->getName(), 9);
                    
                        array_push($this->mails, new Mailinfo($location ,$message));
                        
                    }
                }
            }
            
            return $this->mails;
            
        }
    }
    
}