<?php
session_start();

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}
if(isset($_POST['codigo'])) {
    $codigoComprar = $_POST['codigo'];
} else {
    $codigoComprar = null;
}
if (isset($_POST['comprar']) && $codigoComprar !== null) {
    if (!isset($_SESSION['carrito'][$codigoComprar])) {
        $_SESSION['carrito'][$codigoComprar] = 0;
    }
    
    $productoActual = Producto::getProductoById($codigoComprar);
    if ($productoActual->getStock() > 0) {
        $_SESSION['carrito'][$codigoComprar]++;
        $nuevoStock = $productoActual->getStock() - 1;
        $productoActual->setStock($nuevoStock);
        $productoActual->update(); 
    } else {
        echo "<script>alert('No hay stock disponible para este producto.');</script>";
    }
}
$data['productos'] = Producto::getProductos(); 
?>
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
        <td><form method="post">
            <input type="hidden" name="codigo" value="<?=$producto->getCodigo() ?>">
            <button name="comprar">Comprar</button></form></td>
    </tr>
<?php
}
?>
</table>
</body>
</html>