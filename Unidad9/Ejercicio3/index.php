<?php
include_once "cubo.php";
session_start();

if(!isset($_SESSION['cubos'])){
    $_SESSION['cubos'] = [];
}

// Crear cubo
if(isset($_POST['crear'])){
    $cap = $_POST['capacidad'];
    $cont = $_POST['contenido'];

    if($cont > $cap) $cont = $cap;

    $_SESSION['cubos'][] = new Cubo($cap, $cont);
}

// Verter de un cubo a otro
if(isset($_POST['verter'])){
    $origen = $_POST['cubo1'];
    $destino = $_POST['cubo2'];

    if($origen !== $destino){
        $_SESSION['cubos'][$origen]->verterEn($_SESSION['cubos'][$destino]);
    }
}

// Destruir sesión
if(isset($_POST['destruir'])){
    session_destroy();
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cubos</title>
</head>
<body>

<h2>Lista de Cubos</h2>

<table border="1">
    <tr>
        <th>#</th>
        <th>Capacidad</th>
        <th>Contenido</th>
    </tr>

    <?php
    foreach($_SESSION['cubos'] as $i => $cubo){
        echo "<tr>";
        echo "<td>$i</td>";
        echo "<td>".$cubo->getCapacidad()."</td>";
        echo "<td>".$cubo->getContenido()."</td>";
        echo "</tr>";
    }
    ?>
</table>

<hr><br>

<h2>Crear Cubo</h2>
<form method="post">
    Capacidad: <input type="number" name="capacidad" required><br>
    Contenido: <input type="number" name="contenido" required><br>
    <input type="submit" name="crear" value="Crear Cubo">
</form>

<hr><br>

<h2>Verter de un cubo a otro</h2>
<form method="post">
    Origen:
    <select name="cubo1">
        <?php foreach($_SESSION['cubos'] as $i => $c) echo "<option value='$i'>$i</option>"; ?>
    </select>

    Destino:
    <select name="cubo2">
        <?php foreach($_SESSION['cubos'] as $i => $c) echo "<option value='$i'>$i</option>"; ?>
    </select>

    <input type="submit" name="verter" value="Verter">
</form>

<hr><br>

<form method="post">
    <input type="submit" name="destruir" value="Reiniciar">
</form>

</body>
</html>
