<!DOCTYPE html>
<html>
<head>
    <title>Inserir</title>
    <link rel="stylesheet" href="../Estils/estils.css">
</head>
<body>
    <ul class="ull">
    <li class="liii"><a class="lia" href="index.php"><img src="https://cdn-icons-png.flaticon.com/512/1144/1144760.png" height="25px" style="float: left; margin-right: 10px;"><?php echo $_SESSION['nombre']; ?></a></li>
    <li class="lii"><a class="lia" href="../model/closesess.php">Tencar sessió</a></li>
    </ul>
    <h1>Inserir</h1>
    <form action="../model/inserir.php" method="POST" class="contenidor">
        <label for="titulo">Títol:</label>
        <input type="text" id="titulo" name="titulo"><br><br>
        <label for="articulo">Article:</label>
        <textarea id="articulo" name="articulo" rows="10" cols="50"></textarea><br>
        <p><span style="color: red;"><?php echo $errors; ?></span></p>
        <input type="submit" value="Insertar">
        <input type="button" value="Tornar" onclick="window.location.href='../index.php'">
       
    </form>
</body>
</html>
