<?php

if(isset($_POST['enviar'])){
    $anios = $_POST['anios'] * 365 *24*60*60;
    $meses = $_POST['meses'] * 30 * 24 * 60 * 60;
    $dias = $_POST['dias'] * 24 * 60 *60;
    $fecha = date("d-m-Y");
    $segundosTotales = $anios + $meses + $dias;

    echo "La fecha seria " . date("d-m-Y", strtotime("$fecha + $segundosTotales seconds")) . "<br>";
     echo "La fecha seria " . date("d-m-Y", strtotime("$fecha + $_POST[anios] year $_POST[meses] month  $_POST[dias] days"));
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
    Años:
    <input type="number" name="anios">
    Meses:
    <input type="number" name="meses">
    Dias:
    <input type="number" name="dias">
    <input type="submit" name="enviar" value="enviar">
</form>
    
</body>
</html>