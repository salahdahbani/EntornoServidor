<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 6 </title>
</head>
<body>
<h2>Día de la semana en el futuro</h2>
<form method="post">
    Años: <input type="number" name="anios" value="0"><br>
    Meses: <input type="number" name="meses" value="0"><br>
    Días: <input type="number" name="dias" value="0"><br><br>
    <input type="submit" value="Calcular día futuro">
</form>

<?php
if (isset($_POST['anios'])) {
    $anios = $_POST['anios'];
    $meses = $_POST['meses'];
    $dias = $_POST['dias'];

    // Fecha actual
    $fecha_actual = date("Y-m-d");
    // Sumar tiempo
    $nueva_fecha = strtotime("$fecha_actual +$anios years +$meses months +$dias days");

    $dias_semana = ["domingo", "lunes", "martes", "miércoles", "jueves", "viernes", "sábado"];
    $dia_semana = $dias_semana[date("w", $nueva_fecha)];

    echo "Dentro de $anios años, $meses meses y $dias días será <b>$dia_semana</b> (" . date("d/m/Y", $nueva_fecha) . ")";
}
?>
</body>
</html>
