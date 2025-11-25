<?php
if(isset($_REQUEST['Enviar'])){
    $altura = $_REQUEST['altura'];
    $diametro = $_REQUEST['diametro'];
    $caudal = $_REQUEST['caudal'];
    $radio = $diametro / 2;
    $volumen = pi() * pow($radio, 2) * $altura; // Volumen en m³
    $volumen_litros = $volumen * 1000; // Convertir a litros
    $tiempo_minutos = $volumen_litros / $caudal; // Tiempo en minutos
    $horas = round($tiempo_minutos / 60, 0); // Convertir a horas
    $minutos = (round($tiempo_minutos / 60, 2)) - $horas;
    echo "<h1>Cálculo del tiempo para llenar un cilindro</h1>";
    echo "<h2>El tiempo necesario para llenar el cilindro es: " . $horas . " horas y " . $minutos * 100  . " minutos.</h2>";
    echo "<br><a href='Formulario.php'>Volver al formulario</a>";   
}