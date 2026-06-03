<?php
include 'ProductoImportado.php';
session_start();


if (!isset($_SESSION['productos'])) {
    $_SESSION['productos'] = [];
}

if (!isset($_SESSION['ficheros'])) {
    $_SESSION['ficheros'] = [];
}

if (isset($_POST['aniadir'])) {
    $nuevo_fichero = $_POST['fichero_añadido'];
    $_SESSION['ficheros'][] = $nuevo_fichero;
}

if (isset($_POST['enviar'])) {
    $fichero_Seleccionado = $_POST['fichero_elegido'] ?? '';
$productos = [];
    $id = count($_SESSION['productos']) + 1;
    $nombre = $_REQUEST['nombre'];
    $precioBase = $_REQUEST['precioBase'];
    $tasaAduana = 0.15; // Ejemplo de tasa fija del 15%

    $nuevoProducto = new ProductoImportado($id, $nombre, $precioBase, $tasaAduana);
    $_SESSION['productos'][] = $nuevoProducto;

    echo "Producto '" . $nombre . "' con precio base " . $precioBase . " ha sido agregado correctamente.";
    $contenido = "";
foreach ($productos as $producto) {
    $contenido .= "{$producto->id},{$producto->nombre},{$producto->precioBase},{$producto->tasaAduana}\n";
}
file_put_contents($fichero_Seleccionado, $contenido);
}

if (isset($_POST['confirmar'])){
    $fichero_Seleccionado = $_POST['fichero_elegido'] ?? '';
    // LEER FICHERO
$productos = [];
$lineas = file($fichero_Seleccionado);

foreach ($lineas as $linea) {
    $partes = explode(",", trim($linea));
    $nuevoProducto = new ProductoImportado($id, $nombre, $precioBase, $tasaAduana);
    $nuevoProducto->id = $partes[0];
    $nuevoProducto->nombre = $partes[1];
    $nuevoProducto->precioBase = $partes[2];
    $nuevoProducto->tasaAduana = $partes[3];
    $productos[] = $nuevoProducto;
}
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

    <form method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="precioBase">Precio Base:</label>
        <input type="number" id="precioBase" name="precioBase" step="0.1" required><br><br>

        <input type="submit" name="enviar" value="Enviar">
    </form>

    <form method="post">
        <label for="fichero_añadido">Fichero Añadido:</label>
        <input type="text" id="fichero_añadido" name="fichero_añadido" ><br><br>
        <input type="submit" name="aniadir" value="Añadir"><br><br>
        <label for="fichero_elegido">Cargar Fichero:</label>
        <select name="fichero_elegido">
            <?php
            if (isset($_SESSION['ficheros'])) {
                foreach ($_SESSION['ficheros'] as $valor) {
            ?>
                    <option value="<?= $valor ?>"><?= $valor ?></option>
            <?php
                }
            }
            ?>
        </select>
        <input type="submit" name="confirmar" value="Cargar Fichero">
    </form>

    <h2>Productos Importados:</h2><br>
    <?php
    if (isset($_SESSION['productos']) && count($_SESSION['productos']) > 0) {
        echo "<table border='1' cellpadding='10'>";
        echo "<tr><th>ID</th><th>Nombre</th><th>Precio Base</th><th>Precio Final</th></tr>";

        foreach ($_SESSION['productos'] as $producto) {
            echo "<tr>";
            echo "<td>" . $producto->getId() . "</td>";
            echo "<td>" . $producto->getNombre() . "</td>";
            echo "<td>" . $producto->getPrecioBase() . "</td>";
            echo "<td>" . $producto->calcularPrecioFinal() . "</td>";
            echo "</tr>";
        }
        echo "</table><br>";
    }

    ?>
</body>

</html>