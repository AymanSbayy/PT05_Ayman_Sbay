<?php

/**
 * Función que establece la conexión con la base de datos.
 *
 * @return PDO Objeto PDO que representa la conexión con la base de datos.
 * @throws PDOException Si ocurre un error al conectarse con la base de datos.
 *
 * @see db.constants.php Archivo que contiene las constantes de configuración de la base de datos.
 */
function connexion()
{
    require 'db.constants.php';
    return new PDO("mysql:host=$HOST;dbname=$DB", "$USER", $PASS);
}
?>