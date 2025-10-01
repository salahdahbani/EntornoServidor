<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Documento</title>
</head>
<body>

<?php
  $altura = $_POST["altura"];
  $diametro = $_POST["diametro"];

  $radio = $diametro / 2;
  $volumen = pi() * ($radio * $radio) * $altura;
?>

  <h1>Calculo del volúmen de un cilindro</h1>
  <p>Altura: <?php echo $altura; ?> cm</p>
  <p>Diámetro: <?php echo $diametro; ?> cm</p>
  <p><strong>Volumen:</strong> <?php echo number_format($volumen, 2); ?> cm³</p>

  <img src="descarga.jpg" alt="Imagen de un cilindro" width="200" height="300" />

</body>
</html>
