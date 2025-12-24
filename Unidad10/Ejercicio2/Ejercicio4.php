<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Artículos</title>
</head>
<body>
<h2>
Base de datos <u>banco</u><br>
Tabla <u>articulos</u><br>
</h2>
<?php
try {
    $conexion = new PDO("mysql:host=localhost;dbname=gestisimal;charset=utf8", "root", "toor");
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

// ELIMINAR
if (isset($_POST['eliminar'])) {
    $conexion->exec("DELETE FROM articulos WHERE Código=" . $_POST['Código']);
    echo "Articulo eliminado correctamente.<br>";
}

// MODIFICAR
if (isset($_POST['modificar'])) {
    $margen = $_POST['PrecioV'] - $_POST['PrecioC'];
    $consulta = $conexion->query("SELECT Código FROM articulos WHERE Código=" . $_POST['Código']);
    if ($consulta->rowCount() == 0) {
    $conexion->exec(
        "UPDATE articulos 
        SET Descripción='$_POST[Descripción]', PrecioC='$_POST[PrecioC]', PrecioV='$_POST[PrecioV]', Margen='$margen', Stock='$_POST[Stock]' 
        WHERE Código=" . $_POST['Código]']
    );
    echo "Articulo modificado correctamente.<br>";
     } else {
        echo "Ya existe un articulo con Código " . $_POST['Código'] . "<br>";
    }
}
if (isset($_POST['entrada'])) {
        $conexion->exec(
        "UPDATE articulos 
        SET Stock=Stock + 1
        WHERE Código=" . $_POST['Código'] 
    );
    echo "Entrada realizada correctamente.<br>";
}

if (isset($_POST['salida'])) {
    if ($_POST['Stock'] <= 0) {
        echo "No hay stock disponible para realizar la salida.<br>";
    } else {    
    $conexion->exec(
        "UPDATE articulos 
        SET Stock=Stock - 1
        WHERE Código=" . $_POST['Código'] 
    );
    echo "Salida realizada correctamente.<br>";
}
}

// INSERTAR (DAR DE ALTA)
if (isset($_POST['aniadir'])) {
    $codigo = $_POST['Código'];
    $descripcion = $_POST['Descripción'];
    $precioC = $_POST['PrecioC'];
    $precioV = $_POST['PrecioV'];
    $margen = $precioV - $precioC;    
    $stock = $_POST['Stock'];
    $consulta = $conexion->query("SELECT Código FROM articulos WHERE Código=" . $_POST['Código']);
    if ($consulta->rowCount() == 0) {
        $conexion->exec(
            "INSERT INTO articulos (Código, Descripción, PrecioC, PrecioV, Margen, Stock)
            VALUES ('$codigo','$descripcion','$precioC','$precioV','$margen','$stock')"
        );
        echo "Articulo dado de alta correctamente.<br>";
    } else {
        echo "Ya existe un articulo con Código " . $_POST['Código'] . "<br>";
    }
}

// AHORA HACES EL SELECT PARA MOSTRAR LA TABLA
$consulta = $conexion->query("SELECT Código, Descripción, PrecioC, PrecioV, Margen, Stock FROM articulos");
?>
<table border="1">
<tr>
<td><b>Código</b></td>
<td><b>Descripción</b></td>
<td><b>Precio Compra</b></td>
<td><b>Precio Venta</b></td>
<td><b>Margen</b></td>
<td><b>Stock</b></td>
</tr>
<?php
while ($articulos = $consulta->fetchObject()) {
?>
<tr>
<form method="post">
    <td><?= $articulos->Código ?><input type="hidden" name="Código" value="<?= $articulos->Código ?>"></td>
    <td><input type="text" name="Nombre" value="<?= $articulos->Descripción ?>"></td>
    <td><input type="number" step="0,01" name="PrecioC" value="<?= $articulos->PrecioC ?>"></td>
    <td><input type="number" step="0,01" name="PrecioV" value="<?= $articulos->PrecioV ?>"></td>
    <td><?= $articulos->Margen ?></td>
    <td><input type="number" name="Stock" value="<?= $articulos->Stock ?>"></td>
    <td>
        <input type="submit" value="ELIMINAR" name="eliminar">
        <input type="submit" value="MODIFICAR" name="modificar">
        <input type="submit" value="entrada" name="entrada">
        <input type="submit" value="salida" name="salida">
    </td>
</form>
</tr>

<?php
}
?>
<tr>
<form method="post">
<td>Código <input type="text" name="Código" required></td>
<td>Descripción <input type="text" name="Descripción"></td>
<td>Precio Compra <input type="number" step="0,01" name="PrecioC"></td>
<td>Precio Venta <input type="number" step="0,01" name="PrecioV"></td>
<td>Stock <input type="number" name="Stock"></td>
<td><input type="submit" value="DAR DE ALTA" name="aniadir"></td>
</form>
</tr>
</table>

<br>
Número de artículos: <?= $consulta->rowCount() ?>
<?php $conexion=null; //cerramos la conexión a la BD
?> 

</body>
</html>