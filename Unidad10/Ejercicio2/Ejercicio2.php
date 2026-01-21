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

$consulta = $conexion->query("SELECT DNI, Nombre, Direccion, Teléfono FROM clientes");
$porPagina = 5;

// Página actual (si no hay valor, ponemos 1)
if (isset($_GET['pagina'])) {
    $pagina = $_GET['pagina'];
} else {
    $pagina = 1;
}

// Desde qué cliente empezamos a mostrar
$inicio = ($pagina - 1) * $porPagina;

// Contar total de clientes
$totalClientes = $conexion->query("SELECT COUNT(*) FROM clientes")->fetchColumn();

// Calcular cuántas páginas necesitamos
$totalPaginas = $totalClientes / $porPagina;

// Traer solo los clientes de esta página
$consulta = $conexion->query("SELECT * FROM clientes LIMIT $porPagina OFFSET $inicio");
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
<?php
// Enlace a la página anterior
if ($pagina > 1) {
    $anterior = $pagina - 1;
    echo "<a href='?pagina=$anterior'>Anterior</a> ";
}

// Mostrar los números de página
for ($i = 1; $i <= $totalPaginas; $i++) {
    if ($i == $pagina) {
        echo "<b>$i</b> "; // Página actual en negrita
    } else {
        echo "<a href='?pagina=$i'>$i</a> ";
    }
}

// Enlace a la página siguiente
if ($pagina < $totalPaginas) {
    $siguiente = $pagina + 1;
    echo "<a href='?pagina=$siguiente'>Siguiente</a>";
}
?>
<p>Total de clientes: <?= $totalClientes ?></p>
<?php $conexion=null; //cerramos la conexión a la BD
?> 

</body>
</html>