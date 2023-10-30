<?php 


/**
 * Cierra la sesión actual y redirige al usuario a la página de inicio.
 *
 * @return void
 *
 * @throws Exception Si no se puede iniciar la sesión.
 */
session_start();
session_destroy();

echo "<script>alert('Sessió tancada correctament');</script>";

header('refresh:0.01; url=../index.php');

?>