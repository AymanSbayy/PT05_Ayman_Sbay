<?php 
session_set_cookie_params(300);
session_start();
if (!isset($_SESSION['token'])) {
    $_SESSION['token'] = $_GET['token'];
}

$errors = "";
$token =  $_SESSION['token'];

if (isset($_POST['contra1']) && isset($_POST['contra2'])) {
    require '../controlador/validacions.php';
$contra1 = $_POST['contra1'];
$contra2 = $_POST['contra2'];

if (empty($contra1)) {
    $errors .= "No has introduit la primera contrasenya <br>";
}
if (empty($contra2)) {
    $errors .= "No has introduit la segona contrasenya <br>";
}
if ($contra1 != $contra2) {
    $errors .= "Les contrasenyes no coincideixen <br>";
}
if (validar_contraseña2($contra1))
{
    $errors .= "La contrasenya no compleix els requisits <br>";
}
if (empty($errors)) {
    $contra1 = password_hash($contra1, PASSWORD_DEFAULT);
    require_once '../controlador/validacionsdb.php';
    if (modifyPasswordByToken($token, $contra1)) {
        echo "<script type='text/javascript'>alert('Contrasenya modificada correctament');</script>";
        header('refresh:0.01; url=login.php');
        session_destroy();
    } else {
        $errors .= "No s'ha pogut modificar la contrasenya";
    }
}
}

include '../vista/novacontra.vista.php';


?>