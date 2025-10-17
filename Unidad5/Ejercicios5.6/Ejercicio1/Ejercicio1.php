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

for ($i = 0; $i < 20; $i++) {
    $num = rand(0, 100);
    $numero[$i] = [$num, $num ** 2, $num ** 3];
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
        foreach ($numero[$i] as $n) {
        echo "<td>" . $n . "</td>";
        }
        echo "</tr>";
    }
    ?>
</table><br><br>

</body>
</html>