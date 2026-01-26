<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Listado de productos</title>
</head>
<body>
<h1>Blog de productos</h1>
<hr>
<table border="1" color="black">
    <tr>
        <td>Código:</td>
        <td>Nombre</td>
        <td>Precio</td>
        <td>Stock</td>
        <td>Imagen</td>
        <td><a href="../Controller/carrito.php">Carrito</a></td>
    </tr>
<?php
foreach($data['producto'] as $producto) {
?>
    <tr>
        <td><?=$producto->getCodigo()?></td>
        <td><?=$producto->getNombre()?></td>
        <td><?=$producto->getPrecio()?></td>
        <td><?=$producto->getStock()?></td>
        <td><img src="../View/Images/<?=$producto->getImagen()?>" width="100"></td>
        <td><a href="../Controller/actualizaProducto.php?codigo=<?=$producto->getCodigo()?>">Actualizar</a>
        <a href="../Controller/borraProducto.php?codigo=<?=$producto->getCodigo()?>">Borrar</a></td>
    </tr>
<?php
}
?>
</table>
<br>
<hr>
<a href="../Controller/nuevoProducto.php">Nuevo producto</a>
</body>
</html>