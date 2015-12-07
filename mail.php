<?php


class Mail
{

    public function connect($client)
    {
        $service = new Google_Service_Gmail($client);
        
        $userId = 'me';
        
        $labelList = $service->users_labels->listUsersLabels($userId);

        if (count($labelList->getLabels()) == 0) {
          print "No labels found.\n";
        } else {
          print "Labels:\n";
          foreach ($labelList->getLabels() as $label) {
              
            if (preg_match('/location/',$label->getName()))
            {
                
                $messages = $service->users_messages->listUsersMessages($userId, array("includeSpamTrash" => false, "labelIds" => $label->id));
                
                $messages = $messages->getMessages();
               
                foreach($messages as $message)
                {
                    
                    $message = $service->users_messages->get($userId, $message->id, array("format" => "full"));
                   
                    //see -> http://stackoverflow.com/questions/24503483/reading-messages-from-gmail-in-php-using-gmail-api
                    //$mail_body = base64_decode(strtr($message->getPayload()->getParts()[1]["body"]->data, "-_", "+/"));
                    
                    
                    
                    
                }
                
                //trim the first 9 characters "location/"
                $location = substr($label->getName(), 9);
                
                echo '<!DOCTYPE html>
                <html>
                  <head>
                    <title>Map Your Mails</title>
                    <meta name="viewport" content="initial-scale=1.0">
                    <meta charset="utf-8">
                   
                  </head>
                  <body>
                  <h2>'. $location . '</h2>
                  <p>'. $message->snippet .'</p>
                  
                  
                  </body>
                </html>';  
            }
            else 
            {
                
            }
    
           }
        }
    }
    
    public function fetch()
    {
        
    }
    
}