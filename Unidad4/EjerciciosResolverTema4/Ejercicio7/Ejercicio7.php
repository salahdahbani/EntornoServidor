<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primitiva - Ejercicio 7</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .grid { border-collapse: collapse; }
        .grid td { width: 40px; height: 36px; text-align: center; vertical-align: middle; border: 1px solid #ccc; }
        .verde { background: #c8f7c5; color: #006400; font-weight:bold; }
        .negro { background: #ffffff; color: #000000; }
        .rojo { background: #f7c5c5; color: #9a0000; font-weight:bold; }
        .gris { background: #f0f0f0; color: #666666; }
    </style>
</head>
<body>
    <?php
    $cantidad = $_REQUEST["cantidad"] ?? 0;
    $serie_introducida = $_REQUEST["serie"] ?? 0;

    $combinacion = [];
    while (count($combinacion) < 6) {
        $numAleatorio = rand(1, 49);
        if (!in_array($numAleatorio, $combinacion)) {
            $combinacion[] = $numAleatorio;
        }
    }
    sort($combinacion);

    $serie_generada = rand(1, 999);

    $numeroAciertos = 0;
    $seleccionados = [];
    for ($i = 1; $i <= 49; $i++) {
        if (isset($_REQUEST[$i])) {
            $seleccionados[] = $i;
            if (in_array($i, $combinacion)) {
                $numeroAciertos++;
            }
        }
    }

    echo "<h2>Resultado de la apuesta</h2>";
    echo "<p>Combinación generada: " . implode(", ", $combinacion) . "</p>";
    echo "<p>Números seleccionados: " . count($seleccionados) . ". Aciertos: $numeroAciertos</p>";

    if (count($seleccionados) > 6) {
        echo "<p style=\"color:darkorange; font-weight:bold;\">Has seleccionado más de 6 números: ¡has hecho trampas!</p>";
    } else {
        if ($numeroAciertos == 0) {
            echo "<p>No has ganado nada.</p>";
        } elseif ($numeroAciertos == 4) {
            echo "<p>Has ganado $cantidad euros.</p>";
        } elseif ($numeroAciertos == 5) {
            echo "<p>Has ganado " . ($cantidad + 30) . " euros.</p>";
        } elseif ($numeroAciertos == 6) {
            echo "<p>Has ganado " . ($cantidad + 100) . " euros.</p>";
        }

        if ($serie_introducida == $serie_generada) {
            echo "<p>¡Has acertado el número de serie! Has ganado " . ($cantidad + 500) . " euros.</p>";
        }
    }

    echo "<table class=\"grid\">";
    $num = 1;
    for ($fila = 0; $fila < 7; $fila++) {
        echo "<tr>";
        for ($col = 0; $col < 7; $col++) {
            if ($num <= 49) {
                $clase = 'gris';
                if (in_array($num, $seleccionados) && in_array($num, $combinacion)) {
                    $clase = 'verde';
                } elseif (in_array($num, $seleccionados)) {
                    $clase = 'negro';
                } elseif (in_array($num, $combinacion)) {
                    $clase = 'rojo';
                }
                echo "<td class=\"$clase\">$num</td>";
            } else {
                echo "<td></td>";
            }
            $num++;
        }
        echo "</tr>";
    }
    echo "</table>";
    ?>

    <br>
    <a href="../Ejercicio2/Ejercicio2.html">Volver a jugar</a>
</body>
</html>