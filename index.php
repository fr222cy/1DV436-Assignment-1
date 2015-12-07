<?php
session_start();

require_once("render.php");
require_once("login.php");
require_once("mail.php");


$login = new Login();
$render = new Render();
$mail = new Mail();



$client_id = '116794636592-6q3c6c35kepmhh4avaq9kmitj2b1phi4.apps.googleusercontent.com'; 
$client_secret = 'Raep3Xf79xzetZeaDlV5keLl';

$client = $login->authenticate($client_id, $client_secret);
   
if(isset($client))
{

    $mail->connect($client);
    
    
    //$render->renderMap();  
 
}




     



    

























