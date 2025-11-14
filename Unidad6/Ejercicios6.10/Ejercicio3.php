<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 3 </title>
</head>
<body>
<form method="post">
    Introduce una fecha: <input type="date" name="fecha">
    <input type="submit" value="Mostrar día">
</form>

<?php
if (isset($_POST['fecha'])) {
    $fecha = $_POST['fecha'];
    $dias = ["domingo", "lunes", "martes", "miércoles", "jueves", "viernes", "sábado"];
    $numero = date("w", strtotime($fecha));
    echo "El día de la semana es: " . $dias[$numero];
}
?>
</body>
</html>
