<?php
session_start();

require_once 'autentificacion.php';

require "../controlador/validacionsdb.php";

if (!isset($_SESSION['email'])){
    $email2 = $email;
    $_SESSION['email'] = $email2;
} else {
    $email2 = $_SESSION['email'];
}

if (emailExists($email2))
{
    $dni = getdnibyEmail($email);
    $_SESSION['dni'] = $dni;
    header('location: ../index.php');

}
else {
    header('location: askdni.php');
}



?>