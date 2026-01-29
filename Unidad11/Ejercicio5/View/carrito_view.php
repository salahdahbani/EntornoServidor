<?php
session_start();

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if (isset($_POST['codigo'])) {
    $codigo = $_POST['codigo'];
} else {
    $codigo = null;
}
if ($codigo !== null) {

    if (!isset($_SESSION['carrito'][$codigo])) {
        $_SESSION['carrito'][$codigo] = 0;
    }
    if (isset($_POST['mas'])) {
        $_SESSION['carrito'][$codigo]++;
    }
    if (isset($_POST['menos']) && $_SESSION['carrito'][$codigo] > 0) {
    if (!isset($_SESSION['carrito'][$codigo])) {
        $_SESSION['carrito'][$codigo] = 0;
    }
    $productoActual = Producto::getProductoById($codigo);
    if ($productoActual->getStock() > 0) {
        $_SESSION['carrito'][$codigo]--;
        $nuevoStock = $productoActual->getStock() + 1;
        $productoActual->setStock($nuevoStock);
        $productoActual->update();
}
    }
}
$data['productos'] = Producto::getProductos();

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Carrito</title>
</head>
<body>
<h1>Carrito</h1>
<hr>
<table border="1" color="black">
    <tr>
        <td>Nombre</td>
        <td>Imagen</td>
        <td>Precio</td>
        <td>Unidades</td>
        <td>Total</td>
    </tr>
<?php foreach ($data['producto'] as $producto){

    $codigo = $producto->getCodigo();
    $unidades = $_SESSION['carrito'][$codigo] ?? 0;
    $total = $producto->getPrecio() * $unidades;
?>
<tr>
    <td><?= $producto->getNombre() ?></td>

    <td>
        <img src="../Images/<?= $producto->getImagen() ?>" width="100">
    </td>

    <td><?= $producto->getPrecio() ?> €</td>

    <td>
        <form method="post">
            <input type="hidden" name="codigo" value="<?= $codigo ?>">
            <button name="menos">-</button>
            <?= $unidades ?>
            <button name="mas">+</button>
        </form>
    </td>

    <td><?= $total ?> €</td>
</tr>
<?php } ?>
</table>
<br>
<hr>
<a href="../Controller/index_usuario.php">Volver</a>
</body>
</html>