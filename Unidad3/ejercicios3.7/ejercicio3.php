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
<body bgcolor="<?php echo $color; ?>" text="black">

  <img src="<?php echo $banner; ?>" alt="Banner" width="100%" height="150">

  <div align="<?php echo $alineacion; ?>">

    <font face="<?php echo $fuente; ?>">
  <h1>Bienvenido a tu página personalizada</h1>

  <p>Has configurado esta página con tus preferencias de estilo.</p>
  <p>Color de fondo: <?php echo $color; ?></p>
  <p>Fuente: <?php echo $fuente; ?></p>
  <p>Alineación del texto: <?php echo $alineacion; ?></p>

</body>
</html>
