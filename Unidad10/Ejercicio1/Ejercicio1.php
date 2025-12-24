<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Clientes</title>
</head>
<body>
<h2>
Base de datos <u>banco</u><br>
Tabla <u>cliente</u><br>
</h2>
<?php
try {
    $conexion = new PDO("mysql:host=localhost;dbname=banco;charset=utf8", "root", "toor");
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

// ELIMINAR
if (isset($_POST['eliminar'])) {
    $conexion->exec("DELETE FROM clientes WHERE DNI=" . $_POST['DNI']);
    echo "Cliente eliminado correctamente.<br>";
}

// MODIFICAR
if (isset($_POST['modificar'])) {
    $consulta = $conexion->query("SELECT DNI FROM clientes WHERE DNI=" . $_POST['DNI']);
    if ($consulta->rowCount() == 0) {
    $conexion->exec(
        "UPDATE clientes 
        SET Nombre='$_POST[Nombre]', Direccion='$_POST[Direccion]', Teléfono='$_POST[Teléfono]' 
        WHERE DNI=" . $_POST['DNI']
    );
    echo "Cliente modificado correctamente.<br>";
     } else {
        echo "Ya existe un cliente con DNI " . $_POST['DNI'] . "<br>";
    }
}

// INSERTAR (DAR DE ALTA)
if (isset($_POST['aniadir'])) {
    $consulta = $conexion->query("SELECT DNI FROM clientes WHERE DNI=" . $_POST['DNI']);
    if ($consulta->rowCount() == 0) {
        $conexion->exec(
            "INSERT INTO clientes (DNI, Nombre, Direccion, Teléfono)
            VALUES ('$_POST[DNI]','$_POST[Nombre]','$_POST[Direccion]','$_POST[Teléfono]')"
        );
        echo "Cliente dado de alta correctamente.<br>";
    } else {
        echo "Ya existe un cliente con DNI " . $_POST['DNI'] . "<br>";
    }
}

// AHORA HACES EL SELECT PARA MOSTRAR LA TABLA
$consulta = $conexion->query("SELECT DNI, Nombre, Direccion, Teléfono FROM clientes");
?>
<table border="1">
<tr>
<td><b>DNI</b></td>
<td><b>Nombre</b></td>
<td><b>Dirección</b></td>
<td><b>Teléfono</b></td>
</tr>
<?php
while ($cliente = $consulta->fetchObject()) {
?>
<tr>
<form method="post">
    <td><?= $cliente->DNI ?><input type="hidden" name="DNI" value="<?= $cliente->DNI ?>"></td>
    <td><input type="text" name="Nombre" value="<?= $cliente->Nombre ?>"></td>
    <td><input type="text" name="Direccion" value="<?= $cliente->Direccion ?>"></td>
    <td><input type="text" name="Teléfono" value="<?= $cliente->Teléfono ?>"></td>
    <td>
        <input type="submit" value="ELIMINAR" name="eliminar">
        <input type="submit" value="MODIFICAR" name="modificar">
    </td>
</form>
</tr>

<?php
}
?>
<tr>
<form method="post">
<td>DNI <input type="text" name="DNI" required></td>
<td>Nombre <input type="text" name="Nombre"></td>
<td>Dirección <input type="text" name="Direccion"></td>
<td>Teléfono <input type="tel" name="Teléfono"></td>
<td><input type="submit" value="DAR DE ALTA" name="aniadir"></td>
</form>
</tr>
</table>

<br>
Número de clientes: <?= $consulta->rowCount() ?>
<?php $conexion=null; //cerramos la conexión a la BD
?> 

</body>
</html>