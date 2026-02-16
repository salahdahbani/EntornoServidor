<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../View/style.css" type="text/css">
    <title>Principal</title>
</head>
<body>
<br>
<div>
    <table>
        <tr><th colspan="3"><br><a href="../Controller/login.php">Inicio Sesión/Registro</a><br><br></th></tr>
        <tr><th>IMAGEN</th><th>autor</th><th>likes</th></tr>
<?php
  foreach ($data['fotos'] as $foto) {
    $estilo="";
    // El siguiente if es para resaltar la foto con más likes
    // if ($data['fotoLikes'] && $foto['id']==$data['fotoLikes']->getId()) {
    //     $estilo="style='background-color:red;'";
    // }
?>
        <tr>
            <td><img src="../View/imagen/<?=$foto['imagen']?>" width="200px" height="100px" alt=""></td>
            <td <?= $estilo ?>><?=$foto['autor']?></td>
            <td <?= $estilo ?>><?=$foto['likes']?></td>
        </tr>
<?php
  } 
?>
    </table>
</div>
</body>
</html>