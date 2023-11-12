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
                <a href="<?php echo $client->createAuthUrl() ?>" style="background-color: #24292e; color: #fff; border-radius: 2px; box-shadow: 0 2px 4px 0 rgba(0,0,0,0.25); height: 30px; padding: 0 16px; font-size: 12px; line-height: 30px; font-family: Roboto, sans-serif; text-transform: uppercase; letter-spacing: 0.2px; border: none; display: inline-flex; align-items: center;">
                    <svg viewBox="0 0 16 16" width="20px" height="20px" fill="#fff" style="margin-left: 10px;">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8 0C3.58 0 0 3.582 0 8c0 3.535 2.303 6.533 5.497 7.59.4.074.547-.173.547-.385 0-.19-.007-.693-.01-1.36-2.24.485-2.707-1.082-2.707-1.082-.365-.927-.89-1.173-.89-1.173-.727-.497.055-.487.055-.487.805.057 1.23.827 1.23.827.717 1.23 1.883.874 2.34.666.073-.517.28-.874.508-1.074-1.777-.202-3.644-.888-3.644-3.953 0-.874.312-1.59.827-2.147-.083-.203-.36-1.016.078-2.117 0 0 .67-.215 2.2.82.637-.177 1.317-.265 2-.268.683.003 1.363.091 2 .268 1.53-1.035 2.2-.82 2.2-.82.438 1.1.16 1.914.08 2.117.515.557.826 1.273.826 2.147 0 3.073-1.87 3.75-3.652 3.947.287.248.54.733.54 1.48 0 1.07-.01 1.937-.01 2.198 0 .213.143.462.55.384C13.702 14.53 16 11.53 16 8c0-4.418-3.582-8-8-8z" />
                    </svg>
                    Inicia sessió amb GitHub
                </a>
            </div>
            <p><a href="../model/recuperar.php">Has oblidat la teva contrasenya?</a>.</p>
            <p><a href="../index.php">Tornar</a>.</p>


        </form>

    </div>
</body>

</html>