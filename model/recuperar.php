<?php 
/**
 * Fitxer que permet recuperar la contrasenya d'un usuari a través del correu electrònic.
 *
 * Aquest fitxer conté les funcions necessàries per enviar un correu electrònic amb un enllaç per restablir la contrasenya,
 * així com per actualitzar la base de dades amb el token temporal generat per a l'usuari.
 *
 * PHP version 7.4.9
 *
 * @category   Model
 * @package    PT06_Ayman_Sbay
 * @subpackage Recuperar
 * @license    https://www.gnu.org/licenses/gpl-3.0.en.html GPL
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';             
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$errors = "";

if (!isset($_SESSION['dni'])) {
    if (isset($_POST['correo'])) {
        require_once '../controlador/validacionsdb.php';
        $errors = "";
        
        if (emailExists($_POST['correo'])) {
            if ($errors == "") {
                echo $errors;
                $correo = $_POST['correo'];
                $token = temporaryTokenPass();
                insertTokenintoBD($correo,$token);
                sendMail($correo, $token);  
                echo "<script type='text/javascript'>alert('S\'ha enviat un correu electrònic per restablir la contrasenya');</script>";
            }
            
    }
    else {
        $errors .= "El correu electrònic introduït no existeix. <br>";
    }
          
    }


}

/**
 * Funció que actualitza la base de dades amb el token temporal generat per a l'usuari.
 *
 * Aquesta funció rep el correu electrònic de l'usuari i el token temporal generat per a ell,
 * i actualitza la base de dades amb aquesta informació.
 *
 * @param string $correo Correu electrònic de l'usuari.
 * @param string $token  Token temporal generat per a l'usuari.
 *
 * @return void
 */
function insertTokenintoBD($correo,$token)
{
    //Inserta el token a en el usuario a partir del correo
    require_once '../database/pdo.php';
    $conn = connexion();
    $sql = "UPDATE usuaris SET remember_me_token = :token WHERE Correu = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':token', $token);
    $stmt->bindParam(':email', $correo);
    $stmt->execute();
    $conn = null;
}

/**
 * Funció que envia un correu electrònic amb un enllaç per restablir la contrasenya.
 *
 * Aquesta funció rep el correu electrònic de l'usuari i el token temporal generat per a ell,
 * i envia un correu electrònic amb un enllaç per restablir la contrasenya.
 *
 * @param string $email Correu electrònic de l'usuari.
 * @param string $token Token temporal generat per a l'usuari.
 *
 * @return void
 */
function sendMail($email, $token)
{
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                                       //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'aymanprovass@gmail.com';               //SMTP username
        $mail->Password   = 'zcfv iijr zcyt uktw';                             //SMTP password
        $mail->SMTPSecure = 'ssl';                                  //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('aymanprovass@gmail.com', 'Ayman Sbay');
        $mail->addAddress($email);                                   //Add a recipient

        //Content 
        $mail->isHTML(true);                                         //Set email format to HTML
        $mail->Subject = 'Contraseña';
        // Construir el cuerpo del correo
        $text = "Hola,<br><br>";
        $text .= "Hem rebut una sol·licitud per restablir la contrasenya del teu compte. Si no has sol·licitat aquest canvi, pots ignorar aquest correu electrònic.<br><br>";
        $text .= "Per restablir la teva contrasenya, fes clic en el següent enllaç:<br>";
        $text .= "<a href='localhost/Backend/UF1/PT06_Ayman_Sbay/model/novacontra.php?token=" . $token . "'>Restablir contrasenya</a><br><br>";
        $text .= "Si l'enllaç no funciona, copia i enganxa la següent adreça al teu navegador:<br>";
        $text .= "http://localhost/Backend/UF1/PT06_Ayman_Sbay/model/novacontra.php?token=" . $token . "<br><br>";
        $text .= "Gràcies,<br>";
        $text .= "Ayman Sbay";

        $mail->Body = $text;

        $mail->send();
        $enviat = true;
    } catch (Exception $e) {
    $enviat = false;
    }
}

/**
 * Funció que genera un token temporal per a l'usuari.
 *
 * Aquesta funció genera un token temporal per a l'usuari a partir de bytes aleatoris.
 *
 * @return string
 */
function temporaryTokenPass()
{
    $token = bin2hex(random_bytes(20));
    return $token;
}

include '../vista/recuperar.vista.php';

?>