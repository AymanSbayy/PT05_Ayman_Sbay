<?php
  /**
   * Fitxer de configuració per a l'autenticació amb Google API.
   *
   * Aquest fitxer defineix les credencials del client per a accedir a l'API de Google,
   * així com les scopes necessàries per a obtenir informació de l'usuari.
   *
   * @package     PT06_Ayman_Sbay
   * @subpackage  Model
   * @category    Autenticació
   * @link        http://localhost/Backend/UF1/PT06_Ayman_Sbay/model/loginsocial.php
   */
  require_once '../vendor/autoload.php';

  $clientID = '104014291509-cc69tfsnr1r8nlt7h7a0mln7tdd6r4a1.apps.googleusercontent.com';
  $clientSecret = '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';
  $redirectUri = 'http://localhost/Backend/UF1/PT06_Ayman_Sbay/model/loginsocial.php';

  // create Client Request to access Google API
  $client = new Google_Client();
  $client->setClientId($clientID);
  $client->setClientSecret($clientSecret);
  $client->setRedirectUri($redirectUri);
  $client->addScope("email");
  $client->addScope("profile");

 
?>