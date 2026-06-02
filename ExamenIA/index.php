<?php
include 'ProductoImportado.php';
$_SESSION['productos'] = [];
if(!$_SESSION['productos']){
    $_SESSION['productos'] = [];
}else {
    $productosGuardados = $_SESSION['productos'];
}

if($_POST['enviar']){
    $id = count($_SESSION['productos']) + 1;
    $nombre = $_REQUEST['nombre'];
    $precioBase = $_REQUEST['precioBase'];
    $tasaAduana = 0.15; // Ejemplo de tasa fija del 15%

    $nuevoProducto = new ProductoImportado($id, $nombre, $precioBase, $tasaAduana);
    $_SESSION['productos'][] = $nuevoProducto;

    echo "Producto '" . $nombre . "' con precio base " . $precioBase . " ha sido agregado correctamente.";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form method=post>
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required><br><br>

    <label for="precioBase">Precio Base:</label>
    <input type="number" id="precioBase" name="precioBase" step="0.1" required><br><br>

    <input type="submit" name="enviar" value="Enviar">
</form>

<h2>Productos Importados:</h2><br>
<?php
if(isset($_SESSION['productos']) && count($_SESSION['productos']) > 0){
    foreach($_SESSION['productos'] as $producto){
        echo "<table border='1' cellpadding='10'>";
        echo "<tr><th>ID</th><th>Nombre</th><th>Precio Base</th><th>Precio Final</th></tr>";
        echo "<tr>";
        echo "<td>" . $producto->id . "</td>";
        echo "<td>" . $producto->nombre . "</td>";
        echo "<td>" . $producto->precioBase . "</td>";
        echo "<td>" . $producto->calcularPrecioFinal() . "</td>";
        echo "</tr>";
        echo "</table><br>";
    }
    }
    
?>
</body>
</html>