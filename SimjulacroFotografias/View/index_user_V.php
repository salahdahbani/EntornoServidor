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
    <table style="margin:auto;" border="1">
        <tr><th colspan="4"><br><a href="../Controller/perfil.php"><h2><?= $_SESSION['usuario'] ?></h2></a><br><br></th></tr>
        <tr><th>IMAGEN</th><th>autor</th><th>likes</th><th>Votar</th></tr>
<?php
  foreach ($data['fotos'] as $foto) {
    $estilo="";
    // El siguiente if es para resaltar la foto con más likes
    // if ($data['fotoLikes'] && $foto['id']==$data['fotoLikes']->getId()) {
    //     $estilo="style='background-color:lightgreen;'";
    // }
?>
        <tr>
            <td><a href="../Controller/detalle.php?id=<?= $foto['id'] ?>"><img src="../View/imagen/<?=$foto['imagen']?>" width="200px" height="100px" alt=""></a></td>
            <td <?= $estilo ?>><?=$foto['autor']?></td>
            <td <?= $estilo ?>><?=$foto['likes']?></td>
            <td <?= $estilo ?>>
<?php
        if (Like::getLikeById($foto['id'],$data['id_usuario'])) {
            echo "<h3>Me gusta</h3>";
        }else{
            echo "<a href='../Controller/votar.php?id_foto=$foto[id]'><h3>Dar like</h3></a>";
        }
?>
            </td>
        </tr>
<?php
  } 
?>
    </table>
</div>
</body>
</html>