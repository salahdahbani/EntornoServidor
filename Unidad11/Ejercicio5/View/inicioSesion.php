<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title></title>
</head>
<body>
    <?php $idRecibido = $_REQUEST['id'] ?? ''; ?>
<form action="../Controller/comprobarUsuario.php?id=<?= $idRecibido ?>" method="POST">
    <input type="hidden" name="id" value="<?= $idRecibido ?>">
<h3>Nombre</h3>
<input type="text" name="nombre">
<br><h3>Contraseña</h3>
<input type="password" name="pass">
<input type="hidden" name="rol" value="cliente">
<hr>
<input type="submit" value="Iniciar Sesión">
</form>
<a href="../Controller/nuevoUsuario.php">Registrar nuevo usuario</a>
</body>
</html>