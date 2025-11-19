<?php
include_once "Empleado.php";
session_start();
if(!isset($_SESSION['empleados'])){
    $_SESSION['empleados'] = [];
}

// PROCESAR FORMULARIO PRIMERO
if(isset($_POST['enviar'])){
    $nombre = $_POST['nombre'];
    $sueldo = $_POST['sueldo'];
    $asigno = $_POST['asigno'];
    $dato = new Empleado($nombre, $sueldo);

    // Corregir typo en la sesión
    $_SESSION['empleados'][] = [
        'nombre' => $nombre,
        'sueldo' => $sueldo,
        'asigno' => $asigno,
        'dato' => $dato
    ];
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

<br><br>

<!-- TABLA DESPUÉS DE PROCESAR POST -->
<table border="1">
    <tr>
        <th colspan="5">Empleados</th>
    </tr>
    <tr>
        <td>Nombre</td>
        <td>Sueldo</td>
        <td>Asignar</td>
        <td>Impuestos</td>
    </tr>
    
    <?php
    foreach($_SESSION['empleados'] as $empleados => $datos){   
        echo "<tr>";
        echo "<td>" . $datos['nombre'] . "</td>";
        echo "<td>" . $datos['sueldo'] . "</td>";
        echo "<td>" . $datos['dato']->asigna($datos['nombre'], $datos['asigno']) . "</td>";
        echo "<td>" . $datos['dato']->impuestos() . "</td>";
        echo "</tr>";
    }
    ?>
</table>

<br><br>

<form method="post">
    <label>Introduce el nombre del empleado:</label>
    <input type="text" name="nombre" required> <br>
    <label>Introduce el sueldo del empleado:</label>
    <input type="number" name="sueldo" required> <br>
    <label>Introduce el sueldo que quiere asignarle:</label>
    <input type = "number" name="asigno" > <br>
    <input type="submit" name="enviar">
</form>
<br><br>

</body>
</html>
