<?php
session_start();
include_once "Factura.php";

if (!isset($_SESSION['factura'])) {
    $factura = $_SESSION['factura'] ;
}

 $_SESSION['factura']  = new Factura(date("Y-m-d"), "pendiente");


if (isset($_POST['addProducto'])) {
    $nom = $_POST['nombre'];
    $precio = $_POST['precio'];
    $cant = $_POST['cantidad'];

    $factura->añadeProducto($nom, $precio, $cant);

    $_SESSION['factura'] = $factura;
}


if (isset($_POST['cambiarEstado'])) {
    $factura->setEstado($_POST['estado']);
    $_SESSION['factura'] = $factura;
}

if (isset($_POST['reiniciar'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Factura Interactiva</title>
</head>
<body>

<h1>⭐ Factura Interactiva</h1>

<hr>

<h2>Añadir Producto</h2>
<form method="post">
    Nombre: <input type="text" name="nombre" required><br>
    Precio: <input type="number" step="0.01" name="precio" required><br>
    Cantidad: <input type="number" name="cantidad" required><br><br>
    <input type="submit" name="addProducto" value="Añadir Producto">
</form>

<hr>

<h2>Cambiar Estado</h2>
<form method="post">
    <select name="estado">
        <option value="pendiente">Pendiente</option>
        <option value="pagada">Pagada</option>
    </select>
    <input type="submit" name="cambiarEstado" value="Cambiar">
</form>

<hr>

<h2>Factura Actual</h2>
<?php
$factura->imprimeFactura();
?>

<hr>

<form method="post">
    <input type="submit" name="reiniciar" value="Reiniciar Factura">
</form>

</body>
</html>
