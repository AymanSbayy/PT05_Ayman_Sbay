<?php

/**
 * FILEPATH: /c:/xampp/htdocs/Backend/UF1/PT05_Ayman_Sbay/model/modificar.php
 * 
 * Este archivo contiene la lógica para modificar un artículo en la base de datos.
 * 
 * PHP version 7.4.9
 * 
 * @category Modificar
 * @package  Modificar_Articulo
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/aymansbay/PT05_Ayman_Sbay
 */

session_start();

/**
 * Variables para almacenar el título y contenido del artículo, y los errores.
 * 
 * @var string $errors Errores encontrados al validar los datos del formulario.
 * @var string $titulo Título del artículo enviado por el formulario.
 * @var string $articulo Contenido del artículo enviado por el formulario.
 */

$errors = "";
$titulo = ""; 
$articulo = "";

/**
 * Si no hay una sesión iniciada, se muestra un mensaje de error y se redirige al usuario a la página de inicio de sesión.
 */
if (!isset($_SESSION['dni'])) {
    echo "<script>alert('No has iniciat sessió')</script>";
    header('refresh:0.01; url=../index.php');
} else {
    
    /**
     * Si se han enviado los datos del formulario, se validan y se modifica el artículo en la base de datos.
     */
    if (isset($_POST['titulo2']) && isset($_POST['articulo']) && isset($_POST['id'])) {
        $titulo = $_POST['titulo2'];
        $articulo = $_POST['articulo'];
        $dni = $_SESSION['dni'];
        $id = $_POST['id'];
        if (empty($titulo)) {
            $errors .= "No has introduit el títol <br>";
        }
        if (empty($articulo)) {
            $errors .= "No has introduit l'article";
        }
        if (empty($errors)) {

            modificarArt($dni, $titulo, $articulo, $id);
        }
        
    }

}

/**
 * Se incluye la vista para mostrar el formulario de modificación de artículo.
 */
include "../vista/modificar.vista.php";


/**
 * Función para modificar un artículo en la base de datos.
 * 
 * @param string $dni DNI del usuario que está modificando el artículo.
 * @param string $titulo Nuevo título del artículo.
 * @param string $articulo Nuevo contenido del artículo.
 * @param int $id ID del artículo a modificar.
 * 
 * @return void
 */
function modificarArt($dni, $titulo, $articulo, $id){
    include_once '../database/pdo.php';

    $conn = connexion();
    $sql = "SELECT user_dni FROM articles WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result['user_dni'] != $dni) {
        echo "<script>alert('No pots modificar aquest article')</script>";
        return;
    }
    $sql = "UPDATE articles SET art = :articulo, Títol = :titulo WHERE id = :id AND user_dni = :user_dni";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':articulo', $articulo);
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':user_dni', $dni);
    $stmt->execute();
    echo "<script>alert('Article modificat')</script>";
}
?>
