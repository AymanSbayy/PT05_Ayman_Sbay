<?php

/**
 * FILEPATH: /c:/xampp/htdocs/Backend/UF1/PT06_Ayman_Sbay/model/askdni.php
 * 
 * Aquest fitxer gestiona el procés de registre per als usuaris que s'inscriuen amb el seu DNI.
 * 
 * Versió de PHP 7.4.9
 * 
 * @category Registre
 * @package  Model
 */


session_start();

if (!isset($_SESSION['code'])) {
    $_SESSION['code'] = $_GET['code'];
}

$errors = "";

require 'regautentificacion.php';
require "../controlador/validacionsdb.php";
require '../controlador/validacions.php';

if (!isset($_SESSION['email']) && !isset($_SESSION['name'])) {
    $email2 = $email;
    $name2 = $name;
    $_SESSION['email'] = $email2;
    $_SESSION['name'] = $name2;
} else {
    $email2 = $_SESSION['email'];
    $name2 = $_SESSION['name'];
}

$code =  $_SESSION['code'];



if (emailExists($email2)) {
    $dni = getdnibyEmail($email);
    $_SESSION['dni'] = $dni;
    $nombre = getName($dni);
    $nombre = explode(' ', $nombre)[0];
    $_SESSION['nombre'] = $nombre;
    header('location: ../index.php');
} else {
    if (isset($_POST['dni'])) {
        $dni = $_POST['dni'];
        if (empty($dni)) {
            $errors .= "No has introduit el DNI <br>";
        }
        if (validar_dni2($dni)) {
            $errors .= "El DNI no compleix els requisits <br>";
        }
        if (dniExists($dni)) {
            $errors .= "El DNI ja està registrat <br>";
        }
        if (empty($errors)) {
            if (registerByCode($code, $dni, $_SESSION['email'], $_SESSION['name'])) {
                unset($_SESSION['code']);
                unset($_SESSION['email']);
                unset($_SESSION['name']);
                $_SESSION['dni'] = $dni;
                echo "<script type='text/javascript'>alert('Usuari registrat correctament');</script>";
                header('refresh:0.01; url=login.php');
            } else {
                $errors .= "No s'ha pogut registrar l'usuari";
            }
        }
    }
}

/**
 * Registra un usuari amb el codi, DNI, correu electrònic i nom proporcionats.
 * 
 * @param string $code  El codi de token social.
 * @param string $dni   El DNI de l'usuari.
 * @param string $email El correu electrònic de l'usuari.
 * @param string $name  El nom de l'usuari.
 * 
 * @return bool Retorna true si l'usuari s'ha registrat correctament, false en cas contrari.
 */
function registerByCode($code, $dni, $email, $name)
{

    require_once '../database/pdo.php';
    $conn = connexion();
    $sql = "INSERT INTO usuaris (DNI, Nom, Correu, social_token) VALUES ('$dni', '$name', '$email', '$code')";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $conn = null;
    return true;
}

include '../vista/iserdni.php';

?>