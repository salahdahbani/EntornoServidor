<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Documento</title>
</head>
<body>
  <h1>Resultado de tu jugada</h1>

  <?php
    $n1 = $_POST["num1"];
    $n2 = $_POST["num2"];
    $n3 = $_POST["num3"];
    $n4 = $_POST["num4"];
    $n5 = $_POST["num5"];
    $n6 = $_POST["num6"];
    $serie = $_POST["serie"];

    $g1 = rand(1, 49);
    $g2 = rand(1, 49);
    $g3 = rand(1, 49);
    $g4 = rand(1, 49);
    $g5 = rand(1, 49);
    $g6 = rand(1, 49);
    $serie_generada = rand(1, 999);

    echo "<table>
            <tr>
              <th>Tipo</th>
              <th>N1</th><th>N2</th><th>N3</th><th>N4</th><th>N5</th><th>N6</th>
              <th>Serie</th>
            </tr>
            <tr>
              <td>Usuario</td>
              <td>$n1</td><td>$n2</td><td>$n3</td><td>$n4</td><td>$n5</td><td>$n6</td>
              <td>$serie</td>
            </tr>
            <tr>
              <td>Generado</td>
              <td>$g1</td><td>$g2</td><td>$g3</td><td>$g4</td><td>$g5</td><td>$g6</td>
              <td>$serie_generada</td>
            </tr>
          </table>";
  ?>
</body>
</html>
