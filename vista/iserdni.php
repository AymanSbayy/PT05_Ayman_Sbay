<!DOCTYPE html>
<html>
<head>
    <title>Nova contrasenya</title>
    <link rel="stylesheet" href="../Estils/estils.css">
</head>
<body>

<ul class="ull">
<li class="liii"><a class="lia">Credencials</a></li>
</ul>
    <form action="../model/askdni.php" method="POST" class="contenidor">
        <label for="titulo">Dni </label>
        <input type="text" id="dni" name="dni" size="30"><br><br>
        <input type="submit" name="submit" value="Enviar"><br><br>
        
        <span style="color:red;"><?php if ($errors != "") echo $errors; ?></span>
        
    </form>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><input type="button" value="Tornar al index principal" onclick="window.location.href='../model/login.php'">
    
    

    
</div>
</body>
</html>