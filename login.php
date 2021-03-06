<?php




require_once("google-api-php-client/src/Google/autoload.php");


define('SCOPES', implode(' ', array(
  Google_Service_Gmail::GMAIL_READONLY)
));

class login
{
  
  public function authenticate($client_id, $client_secret)
  {
    
   $redirect_uri = 'https://assignment-1-1dv436-fr222cy.c9users.io/';
    
    $client = new Google_Client();
    
    $client->setClientId($client_id);
    $client->setClientSecret($client_secret);
    $client->setRedirectUri($redirect_uri);
    $client->addScope(SCOPES);
    
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
      return $client;
    } 
    else if($client->isAccessTokenExpired()) 
    {
      $authUrl = $client->createAuthUrl();
      header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
    }
    else 
    {
      $authUrl = $client->createAuthUrl();
    }
    
    
    
    
   
   
    
  }
  
}


