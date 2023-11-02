<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';             
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

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
            }
    }
          
    }


}

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
        $text .= "Hemos recibido una solicitud para restablecer la contraseña de tu cuenta. Si no has solicitado este cambio, puedes ignorar este correo electrónico.<br><br>";
        $text .= "Para restablecer tu contraseña, haz clic en el siguiente enlace:<br>";
        $text .= "<a href='localhost/Backend/UF1/PT06_Ayman_Sbay/model/novacontra.php?token=" . $token . "'>Restablecer contraseña</a><br><br>";
        $text .= "Si el enlace no funciona, copia y pega la siguiente dirección en tu navegador:<br>";
        $text .= "http://localhost/Backend/UF1/PT06_Ayman_Sbay/model/novacontra.php?token=" . $token . "<br><br>";
        $text .= "Gracias,<br>";
        $text .= "El equipo de Ayman Sbay";

        $mail->Body = $text;

        $mail->send();
        $enviat = true;
    } catch (Exception $e) {
    $enviat = false;
    }
}

function temporaryTokenPass()
{
    $token = bin2hex(random_bytes(20));
    return $token;
}

include '../vista/recuperar.vista.php';

?>