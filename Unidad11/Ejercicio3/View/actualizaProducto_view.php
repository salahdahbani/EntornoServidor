<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title></title>
</head>
<body>
<form action="../Controller/updateProducto.php" enctype="multipart/form-data" method="POST">
<input type="hidden" name="codigo" value="<?= $data['producto']->getCodigo() ?>">
<h3>Nombre</h3>
<input type="text" size="40" name="nombre" value="<?= $data['producto']->getNombre() ?>">
<h3>Precio</h3>
<input type="number" step="0.01" size="40" name="precio" value="<?= $data['producto']->getPrecio() ?>">
<h3>Stock</h3>
<input type="number" size="40" name="stock" value="<?= $data['producto']->getStock() ?>">
<h3>Imagen</h3>
<input type="hidden" name="imagenAnterior" value="<?= $data['producto']->getImagen() ?>">
<img src="../View/images/<?= $data['producto']->getImagen() ?>" alt="" width="150px"><br>
<input type="file" id="imagen" name="imagen">
<hr>
<input type="submit" value="Aceptar">
</form>
</body>
</html>