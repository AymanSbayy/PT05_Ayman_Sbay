<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../Estils/register.css">
</head>

<body>
    <div class="register-form">

        <form action="../model/login.php" method="post">

            <label>DNI</label>
            <input type="text" name="dni" value="<?php echo isset($_POST['dni']) ? $_POST['dni'] : ''; ?>">
            <label>Contraseña</label>
            <input type="password" name="password">
            <input type="submit" name="submit" value="Enviar">
            <p style="margin-left: 280px">No estàs registrat? <a href="../model/register.php">Registra't aquí</a>.</p>

            <span style="color: red;"><?php if ($errors != "") echo $errors; ?></span>

            <?php require('autentificacion.php') ?>
            <div class="login-buttons" style="display: flex; justify-content: space-between; align-items: center; margin-top: 10px;">
                <a href="<?php echo $client->createAuthUrl() ?>" style="margin-right: 10px; background-color: #fff; color: #737373; border-radius: 2px; box-shadow: 0 2px 4px 0 rgba(0,0,0,0.25); height: 30px; padding: 0 16px; font-size: 12px; line-height: 30px; font-family: Roboto, sans-serif; text-transform: uppercase; letter-spacing: 0.2px; border: none; display: inline-flex; align-items: center;">
                    <img src="https://www.svgrepo.com/show/475656/google-color.svg" style="margin-right: 10px;" class="w-6 h-6" loading="lazy" height="20px">
                    Inicia sessió amb Google
                </a>
            </div>
            <p><a href="../model/recuperar.php">Has oblidat la teva contrasenya?</a>.</p>
            <p><a href="../index.php">Tornar</a>.</p>


        </form>

    </div>
</body>

</html>