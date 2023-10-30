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
    $numArticles = $result->fetchColumn();
    if ($numArticles != "") {
        return true;
    } else {
        return false;
    }
}

?>
