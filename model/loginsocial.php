<?php
session_start();

require_once 'autentificacion.php';

if (!isset($_SESSION['code'])) {
    $_SESSION['code'] = $_GET['code'];
}

$errors = "";


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
require "../controlador/validacionsdb.php";

if (emailExists($email2))
{
    $dni = getdnibyEmail($email);
    $_SESSION['dni'] = $dni;
    header('location: ../index.php');

}
else {
    if (isset($_POST['dni'])) {
        require '../controlador/validacions.php';
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
            require_once '../controlador/validacionsdb.php';
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
    include '../vista/iserdni.php';
}


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

?>