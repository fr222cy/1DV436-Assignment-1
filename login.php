<?php



session_start();
require_once("google-api-php-client/src/Google/autoload.php");


class login
{

  public function authenticate()
  {
    
  $client_id = '116794636592-6q3c6c35kepmhh4avaq9kmitj2b1phi4.apps.googleusercontent.com'; 
  $client_secret = 'Raep3Xf79xzetZeaDlV5keLl';
  $redirect_uri = 'https://assignment-1-1dv436-fr222cy.c9users.io/';
    
    $client = new Google_Client();
    
    $client->setClientId($client_id);
    $client->setClientSecret($client_secret);
    $client->setRedirectUri($redirect_uri);
    $client->addScope("email");
    $client->addScope("profile");
    
    $service = new Google_Service_Oauth2($client);
    
    if (isset($_GET['code'])) 
    {
      $client->authenticate($_GET['code']);
      $_SESSION['access_token'] = $client->getAccessToken();
      header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
      
       
      exit;
    }
    
    if (isset($_SESSION['access_token']) && $_SESSION['access_token']) 
    {
      $client->setAccessToken($_SESSION['access_token']);
      return true;
    } 
    else 
    {
      $authUrl = $client->createAuthUrl();
      
    }
    echo '<div style="margin:20px">';
    
    if (isset($authUrl))
    { 
    //show login url
    echo '<div align="center">';
    echo '<h3>Login with Google -- Demo</h3>';
    echo '<div>Please click login button to connect to Google.</div>';
    echo '<a class="login" href="' . $authUrl . '"><img src="images/google-login-button.png" /></a>';
    echo '</div>';
    }
   
  }
  
}


