<?php
  /**
   * FILEPATH: /c:/xampp/htdocs/Backend/UF1/PT06_Ayman_Sbay/model/autentificacion.php
   * 
   * Aquest fitxer és responsable d'autenticar l'usuari a través del flux d'autorització de Google OAuth.
   * 
   * @require_once 'configuracion.php';
   * 
   * Si el paràmetre 'code' està definit a la petició GET, s'obté i es configura el token d'accés de l'usuari al client.
   * 
   * L'adreça de correu electrònic i el nom de l'usuari s'obtenen de l'objecte Google_Service_Oauth2.
   * 
   * @var string $email L'adreça de correu electrònic de l'usuari.
   * @var string $name El nom de l'usuari.
   */
  require_once 'configuracion.php';
// authenticate code from Google OAuth Flow
if (isset($_GET['code'])) {
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->setAccessToken($token['access_token']);
  
  // get profile info
  $google_oauth = new Google_Service_Oauth2($client);
  $google_account_info = $google_oauth->userinfo->get();
  $email =  $google_account_info->email;
  $name =  $google_account_info->name;
 


}

?>