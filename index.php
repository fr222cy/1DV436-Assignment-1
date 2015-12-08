<?php
session_start();

require_once("render.php");
require_once("login.php");
require_once("mail.php");


$login = new Login();
$mail = new Mail();

$client_id = '580340564051-6am9ad6fljr3u52q9l8ep0hj43cchlpp.apps.googleusercontent.com'; 
$client_secret = 'XHn5YEFKa1BJHTCsEgBFftwH';

$client = $login->authenticate($client_id, $client_secret);

if(isset($client))
{
    $mail->getMails($client);
    
    $render = new Render($mail);
    $render->renderMap();  
    unset($_SESSION['access_token']);
    
}




     



    

























