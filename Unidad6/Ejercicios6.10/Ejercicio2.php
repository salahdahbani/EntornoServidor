<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Validar hora simple</title>
</head>
<body>
<form method="post">
    Hora: <input type="number" name="hora" min="0" max="23">
    Minuto: <input type="number" name="min" min="0" max="59">
    Segundo: <input type="number" name="seg" min="0" max="59"><br><br>

    Formato:
    <select name="formato">
        <option value="H:i:s">24 horas</option>
        <option value="h:i:s a">12 horas</option>
    </select><br><br>

    <input type="submit" value="Mostrar hora">
</form>

<?php
if (isset($_POST['hora'])) {
    $h = $_POST['hora'];
    $m = $_POST['min'];
    $s = $_POST['seg'];
    $formato = $_POST['formato'];

    if ($h >= 0 && $h <= 23 && $m >= 0 && $m <= 59 && $s >= 0 && $s <= 59) {
        $texto = "$h:$m:$s";
        $hora = strtotime($texto);
        echo "Hora válida: " . date($formato, $hora);
    } else {
        echo "Hora no válida.";
    }
}
?>
</body>
</html>
