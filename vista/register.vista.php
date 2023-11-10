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
            <div class="enlace">
                <?php require('regautentificacion.php') ?>
                <a href="<?php echo $client->createAuthUrl() ?>">Registre't amb Google</a>
            </div>
            <p><a href="../index.php">Tornar</a>.</p>
        </form>
    </div>
</body>
</html>
