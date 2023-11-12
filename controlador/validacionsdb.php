<?php 

/**
 * Verifica si un usuario con el DNI dado ya existe en la base de datos.
 *
 * @param string $id El DNI del usuario a verificar.
 * @return bool Verdadero si el usuario existe, falso en caso contrario.
 */
function idExists($id) {
    include_once '../database/pdo.php';
    $conn = connexion();
    $sql = "SELECT * FROM usuaris WHERE DNI = '$id'";
    $result = $conn->query($sql);
    $numArticles = $result->fetchColumn();
    if ($numArticles != "") {
        return true;
    } else {
        return false;
    }
}

/**
 * Verifica si un usuario con el correo electrónico dado ya existe en la base de datos.
 *
 * @param string $email El correo electrónico del usuario a verificar.
 * @return bool Verdadero si el usuario existe, falso en caso contrario.
 */
function emailExists($email) {
    include_once '../database/pdo.php';
    $conn = connexion();
    $sql = "SELECT * FROM usuaris WHERE Correu = '$email'";
    $result = $conn->query($sql);
    $email2 = $result->fetchColumn();
    if ($email2 != "") {
        return true;
    } else {
        return false;
    }
}

/**
 * Modifica la contraseña de un usuario existente en la base de datos.
 *
 * @param string $id El DNI del usuario a modificar.
 * @param string $password La nueva contraseña del usuario.
 * @return bool Verdadero si la modificación fue exitosa, falso en caso contrario.
 */
function modifyPasswordByToken($token, $password) {
    include_once '../database/pdo.php';
    $conn = connexion();
    $sql = "UPDATE usuaris SET Contraseña = '$password' WHERE remember_me_token = '$token'";
    $result = $conn->exec($sql);
    if ($result !== false) {
        return true;
    } else {
        return false;
    }
}

function getdnibyEmail($email)
{
    include_once '../database/pdo.php';
    $conn = connexion();
    $sql = "SELECT DNI FROM usuaris WHERE Correu = '$email'";
    $result = $conn->query($sql);
    $dni = $result->fetchColumn();
    return $dni;
}

function dniExists($dni)
{
    include_once '../database/pdo.php';
    $conn = connexion();
    $sql = "SELECT * FROM usuaris WHERE DNI = '$dni'";
    $result = $conn->query($sql);
    $dni2 = $result->fetchColumn();
    if ($dni2 != "") {
        return true;
    } else {
        return false;
    }
}

function getName($dni)
{
    include_once '../database/pdo.php';
    $conn = connexion();
    $sql = "SELECT Nom FROM usuaris WHERE DNI = '$dni'";
    $result = $conn->query($sql);
    $nom = $result->fetchColumn();
    return $nom;
}

?>
