<!DOCTYPE html>
<html>
<head>
    <title>Modificar</title>
    <link rel="stylesheet" href="../Estils/estils.css">
    <script defer src="../controlador/article.js"></script>
</head>
<body>
    <ul class="ull">
    <li class="lii"><a class="lia" href="../model/closesess.php">Tencar sessió</a></li>
    </ul>
    <h1>Modificar</h1>
    <form action="../model/modificar.php" method="POST" class="contenidor">
        <label for="id">Numº d'article que vols modificar: </label>
        <input type="number" id="id" name="id" min="0" max="50" step="1"><br><br>
        <label for="titulo">Títol:</label>
        <input type="text" id="titulo2" name="titulo2"><br><br>
        <label for="articulo">Article:</label>
        <textarea id="articulo" name="articulo" rows="10" cols="50"></textarea><br>
        <p><span style="color: red;"><?php echo $errors; ?></span></p>
        <input type="submit" value="Modificar">
        <input type="button" value="Tornar" onclick="window.location.href='../index.php'">
        <p><span style="color: red;">S'ha de tenir en compte que cada article té el seu propi ID. Si vols modificar un article has d'inserir el mateix ID d'aquest.</span></p>
    </form>
    

    
</div>
</body>
</html>
