 <?php
 $aspirantes = [];

    if(isset($_POST['aspirantes'])){
 $aspirantes = unserialize(base64_decode($_POST['aspirantes']));    
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
<input type="hidden" name="aspirantes" value="<?php echo base64_encode(serialize($aspirantes))?>">

</form>

<?php
    if(isset($_POST['finalizar'])){
        echo "<table border=1>
        <tr>
        <th>Num</th>
        <th>Nombre</th>
        <th>Edad</th>
        <th>Años de experiencia</th>
        <th>Correo</th>
        </tr>";
        for ($i = 0; $i < count($aspirantes); $i++) {

    if ($aspirantes[$i]['edad'] >= 30) {

        echo "<tr>";
        echo "<td style='color:red;'>" . $i . "</td>";
        echo "<td style='color:red;'>" . $aspirantes[$i]['nombre'] . "</td>";
        echo "<td style='color:red;'>" . $aspirantes[$i]['edad'] . "</td>";
        echo "<td style='color:red;'>" . $aspirantes[$i]['anios'] . "</td>";
        echo "<td style='color:red;'>" . $aspirantes[$i]['correo'] . "</td>";
        echo "</tr>";

    } else {

        echo "<tr>";
        echo "<td>" . $i . "</td>";
        echo "<td>" . $aspirantes[$i]['nombre'] . "</td>";
        echo "<td>" . $aspirantes[$i]['edad'] . "</td>";
        echo "<td>" . $aspirantes[$i]['anios'] . "</td>";
        echo "<td>" . $aspirantes[$i]['correo'] . "</td>";
        echo "</tr>";
    }
}

echo "</table>";
    }

    echo "<br><br>
    <a href='formulario.php'>Volver al formulario</a>";
    ?>
    
</body>
</html>
