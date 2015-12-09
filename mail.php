<?php

require_once("mailInfo.php");

class Mail
{
    
    private $mails;
    
    public function getMails($client)
    {
        $this->mails = array();
        
        $service = new Google_Service_Gmail($client);
        
        $userId = 'me';
        
        $labelList = $service->users_labels->listUsersLabels($userId);

        if (count($labelList->getLabels()) > 0)
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
         
        } 
        else 
        {
           echo "No labels found.\n"; 
        }
    }
    
    
    public function getMailsToJS()
    {
        
        $timer = 0;
        
        foreach ($this->mails as $mail)
        {
           /* Using Geocoding to get the Location of the email
            * https://developers.google.com/maps/documentation/javascript/examples/geocoding-simple 
            
            */
            //Adds 400 milliseconds to the timer each loop.
            $timer += 400;
            
            $tempString .= "
            
                var timer = parseInt($timer);
                
                setTimeout(function()
                {
                
                var geocoder = new google.maps.Geocoder();
                var address = ". $mail->getLocation() .";
                
                    geocoder.geocode({'address': address}, function(results, status) 
                    {
                        var infowindow = new google.maps.InfoWindow
                        ({
                            content: 
                            ". $mail->getSubject()."+
                            '<h4>Location: '+". $mail->getLocation()."+'</h4>'+
                            ". $mail->getSnippet() ."
                        });
                    
                        if (status === google.maps.GeocoderStatus.OK) 
                        {
                            var marker = new google.maps.Marker
                            ({
                                map: map,
                                position: results[0].geometry.location
                            });
                            
                            marker.addListener('click', function() 
                            {
                                infowindow.open(map, marker);
                            });
                        }
                        
                    });
                },timer);
                 
            ";
            
        }
        
        return $tempString;
        
    }
    
   
    
}