<?php

class render
{
    
    public function renderMap()
    {
        echo  '<!DOCTYPE html>
        <html>
          <head>
            <title>Map Your Mails</title>
            <meta name="viewport" content="initial-scale=1.0">
            <meta charset="utf-8">
            <style>
              html, body {
                height: 100%;
                margin: 0;
                padding: 0;
              }
              #map {
                height: 100%;
              }
            </style>
          </head>
          <body>
            <div id="map"></div>
            <script>
        
        var map;
        function initMap() {
          map = new google.maps.Map(document.getElementById("map"), {
            center: {lat: -34.397, lng: 150.644},
            zoom: 8
          });
        }
        
            </script>
            <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=&signed_in=true&callback=initMap"></script>
          </body>
        </html>';
    }
    
}