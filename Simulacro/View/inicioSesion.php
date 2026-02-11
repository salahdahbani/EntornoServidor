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
<hr>
<input type="submit" value="Iniciar Sesión">
</form>
<a href="../Controller/nuevoUsuario.php">Registrar nuevo usuario</a>
</body>
</html>