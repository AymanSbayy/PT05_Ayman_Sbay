<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../Estils/register.css">
    <script src="https://www.google.com/recaptcha/api.js"></script>
</head>
<body>
    <div class="register-form">
        
        <form action="../model/login.php" method="post">

            <label>DNI</label>
            <input type="text" name="dni" value="<?php echo isset($_POST['dni']) ? $_POST['dni'] : ''; ?>">
            <label>Contraseña</label>
            <input type="password" name="password" ><br>
            <div class="g-recaptcha" data-sitekey="6Lcgj-0oAAAAAHXJKuX07_vN4r2pIbCyUFyQ3PQU"></div><br>
            <input type="submit" name="submit" value="Enviar">
            
            <span style="color: red;"><?php if ($errors != "")echo $errors; ?></span>
            
            <p>No estàs registrat? <a href="../model/register.php">Registra't aquí</a>.</p>
            <p><a href="../vista/recuperar.vista.php">Has oblidat la teva contrasenya?</a>.</p>
            <p><a href="../index.php">Tornar</a>.</p>

            
        </form>
        <form>
            <button class="loginBtn loginBtn--facebook">Inicia sessió amb Facebook</button>
            <button class="loginBtn loginBtn--google">Inicia sessió amb Google</button>
        </form>
    </div>
</body>
</html>
