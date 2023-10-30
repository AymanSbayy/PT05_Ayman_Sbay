<?php
/**
 * Archivo: /c:/xampp/htdocs/Backend/UF1/PT05_Ayman_Sbay/index.php
 * 
 * Este archivo es la página principal del sitio web. Si el usuario no ha iniciado sesión, se mostrarán todos los artículos disponibles en la base de datos. Si el usuario ha iniciado sesión, solo se mostrarán los artículos que ha creado.
 * 
 * PHP version 7.4.9
 * 
 * @category Página principal
 * @package  PT05_Ayman_Sbay
 * @author   Ayman
 */

session_start();

if (!isset($_SESSION['dni'])) {
    $final = "";

    if (!isset($_GET['pagina'])) {
        $pagina = 1;
    } else {
        $pagina = $_GET['pagina'];
    }

    $numArt = Articles();

    $numArticles = totalArticles();
    $pagines = ceil($numArticles / $numArt);

    $inici = ($pagina - 1) * $numArt;

    $art = getArticles($inici, $numArt);

    include 'vista/index.vista.php';
} else {
    $final = "";

    if (!isset($_GET['pagina'])) {
        $pagina = 1;
    } else {
        $pagina = $_GET['pagina'];
    }

    $numArt = Articles();

    $numArticles = totalArticles2();
    $pagines = ceil($numArticles / $numArt);

    $inici = ($pagina - 1) * $numArt;

    $art = getArticles2($_SESSION['dni'], $inici, $numArt);

    include 'vista/index.usuari.php';
}

/**
 * getArticles
 * 
 * Función que busca artículos en la base de datos dependiendo de la página en la que estamos y de los artículos que queremos mostrar.
 * 
 * @param int $inici  Indica desde qué artículo empezar a recuperar.
 * @param int $numArt Número de artículos por página que queremos mostrar.
 * 
 * @return string Retorna la lista de artículos que mostraremos en la vista.
 */
function getArticles($inici, $numArt)
{
    include_once 'database/pdo.php';
    $conn = connexion();

    $sql = "SELECT * FROM articles LIMIT $inici, $numArt";
    $result = $conn->query($sql);

    $art = '';

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $art .= '<li>' . $row['ID'] . ' - ' . $row['Títol'] . ' - ' . $row['art'] . '</li>';
    }

    return $art;
}

/**
 * totalArticles
 * 
 * Función que devuelve el número total de artículos que hay en la base de datos.
 * 
 * @return int Retorna el número total de artículos.
 */
function totalArticles()
{
    include_once 'database/pdo.php';
    try {
        $conn = connexion();
        $sql = "SELECT COUNT(*) FROM articles";
        $result = $conn->query($sql);
        $numArticles = $result->fetchColumn();
        return $numArticles;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

/**
 * totalArticles2
 * 
 * Función que devuelve el número total de artículos que ha creado el usuario que ha iniciado sesión.
 * 
 * @return int Retorna el número total de artículos creados por el usuario.
 */
function totalArticles2()
{
    include_once 'database/pdo.php';
    try {
        $conn = connexion();
        $dni = $_SESSION['dni'];
        $sql = "SELECT COUNT(*) FROM articles WHERE user_dni = '$dni'";
        $result = $conn->query($sql);
        $numArticles = $result->fetchColumn();
        return $numArticles;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

/**
 * Articles
 * 
 * Función que devuelve el número de artículos que queremos mostrar por página.
 * 
 * @return int Retorna el número de artículos que queremos mostrar por página.
 */
function Articles()
{
    if (isset($_GET['numart'])) {
        $_SESSION['numArt'] = $_GET['numart'];
    } else {
        $_SESSION['numArt'] = isset($_SESSION['numArt']) ? $_SESSION['numArt'] : 5;
    }
    return $_SESSION['numArt'];
}

/**
 * getArticles2
 * 
 * Función que busca los artículos creados por el usuario que ha iniciado sesión en la base de datos dependiendo de la página en la que estamos y de los artículos que queremos mostrar.
 * 
 * @param string $dni    DNI del usuario que ha iniciado sesión.
 * @param int    $inici  Indica desde qué artículo empezar a recuperar.
 * @param int    $numArt Número de artículos por página que queremos mostrar.
 * 
 * @return string Retorna la lista de artículos que mostraremos en la vista.
 */
function getArticles2($dni, $inici, $numArt)
{
    include_once 'database/pdo.php';
    $conn = connexion();

    $sql = "SELECT * FROM articles WHERE user_dni = :dni LIMIT :inici, :numArt";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':dni', $dni);
    $stmt->bindParam(':inici', $inici, PDO::PARAM_INT);
    $stmt->bindParam(':numArt', $numArt, PDO::PARAM_INT);
    $stmt->execute();

    $art = '';

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $art .= '<li>' . $row['ID'] . ' - ' . $row['Títol'] . ' - ' . $row['art'] . '</li>';
    }

    return $art;
}
?>