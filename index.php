<?php
session_start();

require_once("render.php");
require_once("login.php");
require_once("mail.php");


$login = new Login();
$mail = new Mail();
$render = new Render($mail);




$client_id = '116794636592-6q3c6c35kepmhh4avaq9kmitj2b1phi4.apps.googleusercontent.com'; 
$client_secret = 'Raep3Xf79xzetZeaDlV5keLl';

$client = $login->authenticate($client_id, $client_secret);



if(isset($client) && isset($_GET))
{

    $mails = $mail->getMails($client);
    
    foreach($mails as $oneMail)
    {
        echo $oneMail->getSubject();
        echo $oneMail->getSnippet();
        echo $oneMail->getMailRecived();
    }
    
  
    
    $render->renderMap($mails);  
 
}




     



    

























