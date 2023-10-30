<?php 

/**
 * Archivo: /c:/xampp/htdocs/Backend/UF1/PT05_Ayman_Sbay/model/login.php
 * Descripción: Este archivo contiene la función de inicio de sesión y la lógica para manejar el inicio de sesión.
 * PHP version 7.4.16
 */

session_start();
$errors = "";
if (!isset($_SESSION['dni'])) {
    if (isset($_POST['dni']) && isset($_POST['password'])) {
        $dni = $_POST['dni'];
        $password = $_POST['password'];

        $errors .=login($dni, $password);
    }
} else {
    header('location: ../index.php');
}
include '../vista/login.vista.php';


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

?>