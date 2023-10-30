<?php
/**
 * Archivo: /c:/xampp/htdocs/Backend/UF1/PT05_Ayman_Sbay/model/inserir.php
 * Descripción: Este archivo contiene la lógica para insertar un artículo en la base de datos.
 * PHP version 7.4.22
 *
 * @category Lógica
 * @package  Inserción de Artículos
 * @author   Ayman
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/aymansbay/PT05_Ayman_Sbay
 */

session_start();

$errors = "";

if (!isset($_SESSION['dni'])) {
    echo "<script>alert('No has iniciat sessió')</script>";
    header('refresh:0.01; url=../index.php');
} else {
    if (isset($_POST['titulo']) && isset($_POST['articulo'])) {
        $titulo = $_POST['titulo'];
        $articulo = $_POST['articulo'];
        $dni = $_SESSION['dni'];
        if (empty($titulo)) {
            $errors .= "No has introduit el títol <br>";
        }
        if (empty($articulo)) {
            $errors .= "No has introduit l'article";
        }
        if (empty($errors)) {
            inserirArt($dni, $titulo, $articulo);
        }
    }
}

include "../vista/insert.vista.php";

/**
 * Función para insertar un artículo en la base de datos.
 *
 * @param string $dni     DNI del usuario que inserta el artículo.
 * @param string $titulo  Título del artículo.
 * @param string $articulo Contenido del artículo.
 *
 * @return void
 */
function inserirArt($dni, $titulo, $articulo)
{
    include_once '../database/pdo.php';

    $conn = connexion();
    $sql = "INSERT INTO articles (id, art, Títol, user_dni) VALUES (:id, :articulo, :titulo, :user_dni)";
    $stmt = $conn->prepare($sql);
    $id = getNextArticlePosition();
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':articulo', $articulo);
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':user_dni', $dni);
    $stmt->execute();
    echo "<script>alert('Article inserit')</script>";
}

/**
 * Función para obtener la siguiente posición disponible para un artículo.
 *
 * @return int La siguiente posición disponible para un artículo.
 */
function getNextArticlePosition()
{
    include_once '../database/pdo.php';

    $conn = connexion();
    $sql = "SELECT id FROM articles ORDER BY id ASC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $used_positions = array_column($result, 'id');
    $next_position = 1;
    while (in_array($next_position, $used_positions)) {
        $next_position++;
    }
    return $next_position;
}
?>