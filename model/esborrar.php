<?php 
/**
 * Función que comprueba si el usuario tiene permisos para borrar un artículo y lo borra si es así.
 *
 * @param int $id El id del artículo a borrar.
 *
 * @return void
 */
function esborrar($id)
{
    include_once '../database/pdo.php';
    $conn = connexion();
    $sql = "SELECT user_dni FROM articles WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $user_dni = $stmt->fetchColumn();

    if ($_SESSION['dni'] != $user_dni) {
        echo "<script>alert('No tens permisos per esborrar aquest article')</script>";
        header('refresh:0.01; url=../index.php');
    } else {
        $sql = "DELETE FROM articles WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        echo "<script>alert('Article esborrat')</script>";
        header('refresh:0.01; url=../index.php');
    }
}

/**
 * Comprueba si el usuario ha iniciado sesión y si tiene permisos para borrar un artículo.
 * Si es así, llama a la función esborrar() para borrar el artículo.
 * Si no, redirige al usuario a la página de inicio de sesión o muestra un mensaje de error.
 *
 * @return void
 */
session_start();
if (!isset($_SESSION['dni'])) {
    header("Location: ../index.php");
} else {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        esborrar($id);
        
    } else {
        echo "<script>alert('No has seleccionat ningun article')</script>";
        header('refresh:0.01; url=../index.php');
    }
}


?>