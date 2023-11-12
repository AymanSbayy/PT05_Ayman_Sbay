<?php
  /**
   * Fitxer que s'encarrega de la autentificació amb Google.
   *
   * Aquest fitxer inclou el fitxer 'regconfiguracion.php' que conté les dades de configuració
   * per a la connexió amb l'API de Google. A més, si es rep un paràmetre 'code' per GET,
   * s'obté el token d'accés a través de l'autorització amb codi i s'estableix com a token d'accés
   * per al client. A continuació, s'obté la informació del compte de Google associat al token
   * d'accés i s'extreu l'email i el nom de l'usuari.
   *
   * PHP version 7.4.9
   *
   * @category Autentificació
   * @package  Regautentificacion.php
   */
  require_once 'regconfiguracion.php';


if (isset($_GET['code'])) {
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->setAccessToken($token['access_token']);
  $token = $client->getAccessToken();
  

  $google_oauth = new Google_Service_Oauth2($client);
  $google_account_info = $google_oauth->userinfo->get();
  $email =  $google_account_info->email;
  $name =  $google_account_info->name;
}
?>