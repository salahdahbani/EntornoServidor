<!DOCTYPE html>
<html lang="en">
<head>          
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 10 - Brisca</title>                
</head>
<body>
<h2>Ejercicio 10: </h2>


<?php
if (isset($_GET['jugar'])) {
    $palos = ["Oros", "Copas", "Espadas", "Bastos"];
    $valores = [1, 2, 3, 4, 5, 6, 7, 10, 11, 12];

    $puntosBrisca = [
        1 => 11,
        3 => 10,
        10 => 2,
        11 => 3,
        12 => 4,
        2 => 0,
        4 => 0,
        5 => 0,
        6 => 0,
        7 => 0
    ];

    $baraja = [];
    foreach ($palos as $palo) {
        foreach ($valores as $valor) {
            $baraja[] = ["valor" => $valor, "palo" => $palo];
        }
    }

    $cartasSeleccionadas = [];
    $indicesUsados = [];

    for ($i = 0; $i < 10;) {
        $indice = rand(0, count($baraja) - 1);
        if (!in_array($indice, $indicesUsados)) {
            $indicesUsados[] = $indice;
            $cartasSeleccionadas[] = $baraja[$indice];
            $i++; 
        }
       
    }

    $totalPuntos = 0;
    echo "<h3>Cartas seleccionadas:</h3><ul>";
    foreach ($cartasSeleccionadas as $carta) {
        $valor = $carta["valor"];
        $palo = $carta["palo"];
        $puntos = $puntosBrisca[$valor];
        echo "<li>$valor de $palo → $puntos puntos</li>";
        $totalPuntos += $puntos;
    }
    echo "</ul>";
    echo "<strong>Total de puntos: $totalPuntos</strong>";
}
?>

<form method="GET">
    <button type="submit" name="jugar" value="1">Sacar 10 cartas</button>
</form>
</body>
</html>
