<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Documento</title>
</head>
<body>

<?php
  $p1 = $_POST["precio1"];
  $p2 = $_POST["precio2"];
  $p3 = $_POST["precio3"];

  $media = ($p1 + $p2 + $p3) / 3;

  $dif1 = $p1 - $media;
  $dif2 = $p2 - $media;
  $dif3 = $p3 - $media;
?>

  <h1>Resultados de comparación de precios</h1>

  <table border="1" >
    <tr>
      <th colspan="2">Tienda</th>
      <th>Precio</th>
      <th>Diferencia con la media</th>
    </tr>
    <tr>
      <td colspan="2">Tienda 1</td>
      <td><?php echo $p1; ?> €</td>
      <td><?php echo $dif1; ?> €</td>
    </tr>
    <tr>
      <td colspan="2">Tienda 2</td>
      <td><?php echo $p2; ?> €</td>
      <td><?php echo $dif2; ?> €</td>
    </tr>
    <tr>
      <td colspan="2">Tienda 3</td>
      <td><?php echo $p3; ?> €</td>
      <td><?php echo $dif3; ?> €</td>
    </tr>
    <tr>
      <th colspan="2">Media</th>
      <th colspan="2"><?php echo number_format($media, 2); ?> €</th>
    </tr>
  </table>

</body>
</html>
