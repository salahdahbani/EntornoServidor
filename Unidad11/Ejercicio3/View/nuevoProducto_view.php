<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title></title>
</head>
<body>
<form action="../Controller/grabaProducto.php" enctype="multipart/form-data" method="POST">
<h3>Nombre</h3>
<input type="text" name="nombre">
<br><h3>Precio</h3>
<input type="number" step="0.01" name="precio">
<br><h3>Stock</h3>
<input type="number" size="40" name="stock">
<br><h3>Imagen</h3>
<input type="file" id="imagen" name="imagen">
<hr>
<input type="submit" value="Aceptar">
</form>
</body>
</html>