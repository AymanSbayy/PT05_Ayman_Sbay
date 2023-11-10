<?php
  require_once '../vendor/autoload.php';

  $clientID = '104014291509-cc69tfsnr1r8nlt7h7a0mln7tdd6r4a1.apps.googleusercontent.com';
  $clientSecret = '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';
  $redirectUri = 'http://localhost/Backend/UF1/PT06_Ayman_Sbay/model/askdni.php';

  // create Client Request to access Google API
  $client = new Google_Client();
  $client->setClientId($clientID);
  $client->setClientSecret($clientSecret);
  $client->setRedirectUri($redirectUri);
  $client->addScope("email");
  $client->addScope("profile");

 
?>