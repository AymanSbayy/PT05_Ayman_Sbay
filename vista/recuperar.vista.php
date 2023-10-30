<!DOCTYPE html>
<html>
<head>
    <title>Modificar</title>
    <link rel="stylesheet" href="../Estils/estils.css">
    <script defer src="../controlador/article.js"></script>
</head>
<body>

<ul class="ull">
<li class="liii"><a class="lia">Anònim</a></li>
</ul>
    <h1>Modificar</h1>
    <form action="../model/recuperar.php" method="POST" class="contenidor">
        <label for="titulo">Correu: </label>
        <input type="text" id="correo" name="correo"><br><br>
        <input type="submit" name="submit" value="Enviar">
        <input type="button" value="Tornar" onclick="window.location.href='../model/login.php'">
    </form>
    

    
</div>
</body>
</html>
