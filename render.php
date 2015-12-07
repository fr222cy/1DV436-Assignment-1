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
    <title>Info windows</title>
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



function initMap() {
  var uluru = {lat: -25.363, lng: 131.044};
  var map = new google.maps.Map(document.getElementById("map"), {
    zoom: 4,
    center: uluru
  });

 var contentString = "<p> hi </p>";

  var infowindow = new google.maps.InfoWindow({
    content: contentString
  });

  var marker = new google.maps.Marker({
    position: uluru,
    map: map,
    title: "Uluru (Ayers Rock)"
  });
  marker.addListener("click", function() {
    infowindow.open(map, marker);
  });
}

    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWpCS2vmkJ4eFJsZUu_Mxs4hiN520T5Nk&signed_in=true&callback=initMap"></script>
  </body>
</html>';
    }
    
}