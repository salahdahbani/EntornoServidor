<?php
session_start();

if (!isset($_SESSION['productos'])) {
    $_SESSION['productos'] = [];
}
if (isset($_POST['añadir'])) {
    $nuevo_producto = $_POST['productos'];
    $numero_productos = count($_SESSION['productos']);
    $numero_letras = strlen($nuevo_producto);
    $codigo_pro = strtoupper(substr($nuevo_producto, 0, 3));
    $_SESSION['productos'][] = ['nombre' => $nuevo_producto,'numero' => $numero_letras, 'codigo' => $codigo_pro];
}

if (isset($_POST['empezar_nuevo'])) {
    $_SESSION['productos'] = [];

    setcookie('datos', '', time() - 3600);
}

setcookie('datos', base64_encode(serialize($_SESSION['productos'])), time() + 3600);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<form method="post">
    <input type="text" name="productos" >
    <input type="submit" name="añadir" value="Añadir" required>
    <input type="submit" name="terminar" value="terminar">
    <input type="submit" name="empezar_nuevo" value="EMPEZAR NUEVO">
</form>
<?php

if (isset($_COOKIE['datos']) && isset($_POST['terminar'])) {
    $productos_guardados = base64_decode($_COOKIE['datos']);
    $original_productos = unserialize($productos_guardados);
    echo "Productos guardados en la cookie: <br>";
    echo "Número de productos: " . count($original_productos) . "<br>";
    foreach ($original_productos as $producto) {
        echo "" . $producto['nombre'] . " - [" . $producto['codigo'] . "," . $producto['numero'] . "] <br>";
    }
}

?>
    
</body>
</html>