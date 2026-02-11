<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title></title>
</head>
<body>
<form action="../Controller/grabaUsuario.php" method="POST">
<h3>Nombre</h3>
<input type="text" name="nombre">
<br><h3>Contraseña</h3>
<input type="password" name="pass">
<input type="hidden" name="rol" value="cliente">

<hr>
<input type="submit" value="Registrar">
</form>
</body>
</html>