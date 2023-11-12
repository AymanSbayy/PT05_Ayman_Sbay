<?php 


/**
 * Cierra la sesión actual y redirige al usuario a la página de inicio.
 *
 * @return void
 *
 * @throws Exception Si no se puede iniciar la sesión.
 */
session_start();

if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
    session_destroy();
    echo "<script>alert('Sessió tancada correctament');</script>";
    header('refresh:0.01; url=../index.php');
} else {
    echo "<script>
            if(confirm('Estàs segur que vols tancar la sessió?')) {
                window.location.href = 'closesess.php?confirm=yes';
            } else {
                window.location.href = '../index.php';
            }
        </script>";
}


?>