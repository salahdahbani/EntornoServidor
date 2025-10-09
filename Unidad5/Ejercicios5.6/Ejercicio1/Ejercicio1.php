<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $numero = [];
$cuadrado = [];
$cubo = [];

// Llenar el array 'numero' con valores aleatorios entre 0 y 100
for ($i = 0; $i < 20; $i++) {
    $num = rand(0, 100);
    $numero[] = $num;
    $cuadrado[] = $num ** 2;
    $cubo[] = $num ** 3;
}

?>
<table border="1">
    <tr>
        <th>Número</th>
        <th>Cuadrado</th>
        <th>Cubo</th>
    </tr>
    <?php
    for ($i = 0; $i < 20; $i++) {
        echo "<tr>";
        echo "<td>" . $numero[$i] . "</td>";
        echo "<td>" . $cuadrado[$i] . "</td>";
        echo "<td>" . $cubo[$i] . "</td>";
        echo "</tr>";
    }
    ?>
</table><br><br>

</body>
</html>