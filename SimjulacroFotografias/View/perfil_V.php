<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil Usuario</title>
</head>
<body>
<div>
    <h1>Perfil del usuario <?= $_SESSION['usuario'] ?></h1>
    <form action="../Controller/index.php">
      <input type="submit" name="cerrar" value="Cerrar Sesión">
      <input type="submit" name="volver" value="Pagina principal">
    </form>
    <br><br>
    <form action="../Controller/perfil.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
      <fieldset>
        <legend>Subir una imagen</legend>
        <input name="imagen" type="file" required/></h3>
        <input type="submit" name="insertar" value="Aceptar">
      </fieldset>
    </form>
    <br><br><hr>
<?php
  foreach ($data['fotos'] as $foto) {
?>
            <img src="../View/imagen/<?=$foto['imagen']?>" width="200px" height="100px" alt="">
            <strong>Likes acumulados: <?=$foto['likes']?></strong><hr>
<?php
  } 
?>
</div>
</body>
</html>