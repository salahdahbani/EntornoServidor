<?php
$numero_correcto = rand(100000, 999999);
$numero_serie = rand(100, 999);
if(isset($_POST['Enviar'])){
    $combinacion = $_POST['combinacion'];
    $serie = $_POST['serie'];
    echo "<table border='1'>";
    echo "<th colspan='2'><h1>Resultado de la combinación</h1></th>";
    echo "<tr><td>Combinación Generada: " . $numero_correcto . "</td>";
    echo "<td>Número de Serie Generado: " . $numero_serie . "</td></tr>";
    echo "<tr><td><p>Combinación introducida: " . $combinacion . "</p></td>";
    echo "<td><p>Número de serie introducido: " . $serie . "</p></td></tr>";
    echo "</table>";
    
    if($combinacion == $numero_correcto && $serie == $numero_serie){
        echo "<h2>¡Felicidades! Has acertado la combinación y el número de serie.</h2>";
    } else {
        echo "<h2>Lo siento, la combinación o el número de serie son incorrectos.</h2>";
    }
    echo "<br><a href='Formulario.php'>Volver al formulario</a>";
}
?>

