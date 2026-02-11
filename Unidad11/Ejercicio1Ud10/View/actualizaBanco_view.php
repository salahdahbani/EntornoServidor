<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title></title>
</head>
<body>
<form action="../Controller/updateCliente.php" enctype="multipart/form-data"
method="POST">
<input type="hidden" name="DNI" value="<?= $data['clientes']->getDNI() ?>">
<h3>Nombre</h3>
<input type="text" size="40" name="nombre" value="<?= $data['clientes']->getNombre() ?>">
<h3>Dirección</h3>
<input type="text" size="40" name="direccion" value="<?= $data['clientes']->getDireccion() ?>">
<h3>Teléfono</h3>
<input type="number" size="40" name="telefono" value="<?= $data['clientes']->getTelefono() ?>">
<br>
<hr>
<input type="submit" value="Aceptar">
</form>
</body>
</html>