<?php
/**
 * Fitxer: /c:/xampp/htdocs/Backend/UF1/PT06_Ayman_Sbay/model/login.php
 * Descripció: Aquest fitxer conté la funció d'inici de sessió i la lògica per gestionar l'inici de sessió.
 * Versió de PHP: 7.4.16
 */

$errors = "";

/**
 * Inicia la sessió i comprova si s'ha superat el límit de captcha. Si no s'ha superat, comprova si l'usuari ha iniciat sessió. Si no, comprova si s'ha enviat el formulari d'inici de sessió 
 * i crida la funció login() per validar les credencials. Si s'ha superat el límit de captcha, comprova si l'usuari ha iniciat sessió. Si no, comprova si s'ha enviat el formulari d'inici de 
 * sessió i crida la funció login2() per validar les credencials i el captcha.
 */
session_start();
if (!isset($_SESSION['captcha'])) {
    $_SESSION['captcha'] = 0;
} else {
    $_SESSION['captcha'] = $_SESSION['captcha'] + 1;
}


require '../controlador/validacionsdb.php';
if (!($_SESSION['captcha'] > 3)) {
    if (!isset($_SESSION['dni'])) {
        if (isset($_POST['dni']) && isset($_POST['password'])) {
            $dni = $_POST['dni'];
            $password = $_POST['password'];
            
            $errors .= login($dni, $password);
        }
    } else {
        unset($_SESSION['captcha']);
        header('location: ../index.php');
    }
    include '../vista/login.vista.php';
} else {
    if (!isset($_SESSION['dni'])) {
        if (isset($_POST['dni']) && isset($_POST['password'])) {
            $dni = $_POST['dni'];
            $password = $_POST['password'];

            $errors .= login2($dni, $password);
        }
    } else {
        unset($_SESSION['captcha']);
        header('location: ../index.php');
    }
    require '../controlador/validacionsdb.php';
$name = getName($_SESSION['dni']);
$name = explode(' ', $name)[0];
$_SESSION['nombre'] = $name;

    include '../vista/login.vista2.php';
}

/**
 * Funció per validar les credencials de l'usuari i iniciar sessió si són correctes.
 *
 * @param string $dni      El DNI de l'usuari.
 * @param string $password La contrasenya de l'usuari.
 *
 * @return string          Retorna una cadena amb els errors si n'hi ha.
 */
function login($dni, $password)
{
    require_once "../database/pdo.php";
    $errors = "";

    if (empty($dni)) {
        $errors .= "El DNI és obligatori. <br>";
    }

    if (empty($password)) {
        $errors .= "La contrasenya és obligatòria. <br>";
    }

    if (empty($errors)) {
        $conn = connexion();
        $sql = "SELECT Contraseña FROM usuaris WHERE DNI = '$dni'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (is_array($result) && array_key_exists('Contraseña', $result) && password_verify($password, $result['Contraseña'])) {
            $_SESSION['dni'] = $dni;
            
            $nombre = getName($dni);
            $nombre = explode(' ', $nombre)[0];
            $_SESSION['nombre'] = $nombre;
            header('location: ../index.php');
        } else {
            $errors .= "El DNI o la contrasenya introduïts no són correctes. <br>";
        }
    }
    return $errors;
}

/**
 * Funció per validar les credencials de l'usuari i el captcha i iniciar sessió si són correctes.
 *
 * @param string $dni      El DNI de l'usuari.
 * @param string $password La contrasenya de l'usuari.
 *
 * @return string          Retorna una cadena amb els errors si n'hi ha.
 */
function login2($dni, $password)
{
    require_once "../database/pdo.php";
    $errors = "";
    if (isset($_POST['g-recaptcha-response'])) {
        $captcha = $_POST['g-recaptcha-response'];
        $secret = '6Lcgj-0oAAAAAP4_xNkbcRPW5w6Gifouj3lV0x_6';
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");
        $arr = json_decode($response, TRUE);

        if (!($arr['success'])) {
            $errors .= "No has fet el captcha <br>";
        }
    }
    if (empty($dni)) {
        $errors .= "El DNI és obligatori. <br>";
    }

    if (empty($password)) {
        $errors .= "La contrasenya és obligatòria. <br>";
    }

    if (empty($errors)) {
        unset($_SESSION['captcha']);
        $timeout = 25 * 60;
        $conn = connexion();
        $sql = "SELECT Contraseña FROM usuaris WHERE DNI = '$dni'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (is_array($result) && array_key_exists('Contraseña', $result) && password_verify($password, $result['Contraseña'])) {
            ini_set("session.gc_maxlifetime", $timeout);
            $_SESSION['dni'] = $dni;

            $nombre = getName($dni);
            $nombre = explode(' ', $nombre)[0];
            $_SESSION['nombre'] = $nombre;
            header('location: ../index.php');
        } else {
            $errors .= "El DNI o la contrasenya introduïts no són correctes. <br>";
        }
    }
    return $errors;
}
