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
            <input type="password" name="password" >
            <input type="submit" name="submit" value="Enviar">
            <span style="color: red;"><?php if ($errors != "")echo $errors; ?></span>
            <p>No estàs registrat? <a href="../model/register.php">Registra't aquí</a>.</p>
            <p><a href="../index.php">Tornar</a>.</p>
        </form>
    </div>
</body>
</html>
