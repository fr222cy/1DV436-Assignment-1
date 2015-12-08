<?php

class render
{
    
    private $mail;
    
    public function __construct(Mail $mail)
    {
        $this->mail = $mail;
    }
    
    public function renderMap()
    {
        echo  '<!DOCTYPE html>
    <html>
      <head>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <meta charset="utf-8">
        
        <title>Map your Mails</title>
        
          <style>
            html, body 
            {
              height: 100%;
              margin: 0;
              padding: 0;
            }
            #map 
            {
              height: 100%;
            }
          </style>
          
        </head>
        <body>
        <div id="map"></div>
        <script>
    
    
        function initMap() 
        {
          var center = {lat: 51.516, lng:9.9167 };
        
          var map = new google.maps.Map(document.getElementById("map"), {
          zoom: 4,
          center: center
          });
        
          '. $this->mail->getMailsToJS() .'
        
        }
    
        </script>
        
        <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBeIg-ch-fNUC-O7RIPjy9dt2txEprQRSk&signed_in=true&callback=initMap">
        </script>
        
      </body>
    </html>';
    }
    
}