<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
    <link rel="stylesheet" type="text/css" href="../Estils/register.css">
</head>
<body>
    <div class="register-form">
        <form action="../model/register.php" method="post">
            <label for="username">DNI:</label>
            <input type="text" name="dni" value="<?php echo isset($_POST['dni']) ? $_POST['dni'] : ''; ?>">
            <label for="username">Nom d'usuari:</label>
            <input type="text" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>">
            <label for="email">Correu electrònic:</label>
            <input type="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
            <label for="password">Contrasenya:</label>
            <input type="password" name="password" required>
            <label for="confirm_password">Confirmar contrasenya:</label>
            <input type="password" name="confirm_password" required>
            <input type="submit" value="Registrarse">
            <span style="color: red;"><?php if ($errors != "")echo $errors; ?></span>
            <p>Si ja tens un compte, <a href="../model/login.php">Inicia sessió</a>.</p>
            <?php require('regautentificacion.php') ?>
            <div class="login-buttons" style="display: flex; justify-content: space-between; align-items: center; margin-top: 10px;">
                <a href="<?php echo $client->createAuthUrl() ?>" style="margin-right: 10px; background-color: #fff; color: #737373; border-radius: 2px; box-shadow: 0 2px 4px 0 rgba(0,0,0,0.25); height: 30px; padding: 0 16px; font-size: 12px; line-height: 30px; font-family: Roboto, sans-serif; text-transform: uppercase; letter-spacing: 0.2px; border: none; display: inline-flex; align-items: center;">
                    <img src="https://www.svgrepo.com/show/475656/google-color.svg" style="margin-right: 10px;" class="w-6 h-6" loading="lazy" height="20px">
                    Inicia sessió amb Google
                </a>
            </div><br>
            <p><a href="../index.php">Tornar</a>.</p>
        </form>
    </div>
</body>
</html>
