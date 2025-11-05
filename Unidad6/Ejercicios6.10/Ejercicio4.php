<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 4 </title>
</head>
<body>
<form method="post">
    Introduce una fecha: <input type="date" name="fecha">
    <input type="submit" value="Mostrar formato largo">
</form>

<?php
if (isset($_POST['fecha'])) {
    $fecha = $_POST['fecha'];
    $dia = date("j", strtotime($fecha));
    $meses = [1=>"enero",2=>"febrero",3=>"marzo",4=>"abril",5=>"mayo",6=>"junio",7=>"julio",8=>"agosto",9=>"septiembre",10=>"octubre",11=>"noviembre",12=>"diciembre"];
    $mes = $meses[date("n", strtotime($fecha))];
    $anio = date("Y", strtotime($fecha));
    echo "$dia de $mes de $anio";
}
?>
</body>
</html>
