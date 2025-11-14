<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 5 - Próximo día</title>
</head>
<body>
<form method="post">
    Elige un día:
    <select name="dia">
        <option value="Monday">Lunes</option>
        <option value="Tuesday">Martes</option>
        <option value="Wednesday">Miércoles</option>
        <option value="Thursday">Jueves</option>
        <option value="Friday">Viernes</option>
        <option value="Saturday">Sábado</option>
        <option value="Sunday">Domingo</option>
    </select>
    <input type="submit" value="Ver próximo día">
</form>

<?php
if (isset($_POST['dia'])) {
    $dia = $_POST['dia'];
    $fecha = strtotime("next $dia");
    echo "La fecha del próximo $dia es: " . date("d/m/Y", $fecha);
}
?>
</body>
</html>
