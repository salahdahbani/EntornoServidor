<?php
  $color = $_POST["color"];
  $fuente = $_POST["fuente"];
  $alineacion = $_POST["alineacion"];
  $banner = $_POST["banner"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Documento</title>
</head>
<!-- Aplicamos el color con la etiqueta <body> -->
<body bgcolor="<?php echo $color; ?>" text="black">

  <!-- Mostramos la imagen -->
  <img src="<?php echo $banner; ?>" alt="Banner" width="100%" height="150">

  <!-- Aplicamos alineación-->
  <div align="<?php echo $alineacion; ?>">

    <!-- Aplicamos fuente -->
    <font face="<?php echo $fuente; ?>">
  <h1>Bienvenido a tu página personalizada</h1>

  <p>Has configurado esta página con tus preferencias de estilo.</p>
  <p>Color de fondo: <?php echo $color; ?></p>
  <p>Fuente: <?php echo $fuente; ?></p>
  <p>Alineación del texto: <?php echo $alineacion; ?></p>

</body>
</html>
