<?php


require_once("render.php");
require_once("login.php");



$login = new Login();
$render = new Render();

    

if($login->authenticate() == true)
{
    
    
    
    
    $render->renderMap();  
    session_unset();
}



     



    

























