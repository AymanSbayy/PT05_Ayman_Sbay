<!DOCTYPE html>
<html>
<head>
    <title>Nova contrasenya</title>
    <link rel="stylesheet" href="../Estils/estils.css">
</head>
<body>

<ul class="ull">
<li class="liii"><a class="lia">Anònim</a></li>
</ul>
    <h1>Nova contrasenya</h1>
    <form action="../model/novacontra.php" method="POST" class="contenidor">
        <label for="titulo">Contresenya: </label>
        <input type="password" id="contra1" name="contra1" size="30"><br><br>
        <label for="titulo">Repeteix la contresenya: </label>
        <input type="password" id="contra2" name="contra2" size="30"><br><br>
        <input type="submit" name="submit" value="Enviar"><br><br>
        
        
        <span style="color:red"><?php echo $errors ?></span>
    </form>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><input type="button" value="Tornar al index principal" onclick="window.location.href='../model/login.php'">
    
    

    
</div>
</body>
</html>