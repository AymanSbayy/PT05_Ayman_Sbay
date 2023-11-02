<?php

/**
 * Archivo: /c:/xampp/htdocs/Backend/UF1/PT05_Ayman_Sbay/model/login.php
 * Descripción: Este archivo contiene la función de inicio de sesión y la lógica para manejar el inicio de sesión.
 * PHP version 7.4.16
 */

session_start();
$errors = "";

if (!isset($_SESSION['captcha'])) {
    $_SESSION['captcha'] = 0;
} else {
    $_SESSION['captcha'] = $_SESSION['captcha'] + 1;
}

if (!($_SESSION['captcha'] > 3)) {
    if (!isset($_SESSION['dni'])) {
        if (isset($_POST['dni']) && isset($_POST['password'])) {
            $dni = $_POST['dni'];
            $password = $_POST['password'];

            $errors .= login($dni, $password);
        }
    } else {
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
        header('location: ../index.php');
    }
    include '../vista/login.vista2.php';
}


/**
 * Función para manejar el inicio de sesión.
 *
 * @param string $dni      El DNI del usuario.
 * @param string $password La contraseña del usuario.
 *
 * @return string          Devuelve una cadena de errores si los hay.
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
            header('location: ../index.php');
        } else {
            $errors .= "El DNI o la contrasenya introduïts no són correctes. <br>";
        }
    }
    return $errors;
}


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
            ini_set( "session.gc_maxlifetime", $timeout );
            $_SESSION['dni'] = $dni;
            header('location: ../index.php');
        } else {
            $errors .= "El DNI o la contrasenya introduïts no són correctes. <br>";
        }
    }
    return $errors;
}
