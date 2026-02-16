<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle</title>
</head>
<body>
<div>
    <h1>Detalle de la imagen</h1>
    <img src="../View/imagen/<?=$data['foto']->getImagen()?>" width="400px" alt="">
    <br><br>
    <h2>Autor: <?=$data['autor']?></h2>
    <hr>
    <h2>Usuarios que han dado like:</h2>
<?php
  foreach ($data['usuarios'] as $user) {
?>
            <h3><?=$user->getNombre()?></h3>
<?php
  } 
?>
    <hr><br>
    <form action="../Controller/index.php">
      <input type="submit" name="volver" value="Pagina principal">
    </form>
</div>
</body>
</html>