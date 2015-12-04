<?php

session_start();
require_once("render.php");
require_once("login.php");


//set_include_path('google-api-php-client/src');
//require_once("google-api-php-client/src/Google/autoload.php");

$login = new Login();

$login->authenticate();


//$client->setApplicationName("1DV436AS1");
//$client->setDeveloperKey("AIzaSyBWpCS2vmkJ4eFJsZUu_Mxs4hiN520T5Nk");











