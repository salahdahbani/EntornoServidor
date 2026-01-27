<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Listado de artículos</title>
</head>
<body>
<h1>Blog de artículos</h1>
<a href="../Controller/nuevoBlog.php">Nuevo artículo</a>
<hr>
<?php
foreach($data['articulo'] as $articulo) {
?>
<h3><?=$articulo->getTitulo()?></h3>
<p><?=$articulo->getFecha()?></p><br>
<p><?=$articulo->getContenido()?></p><br>
<a href="../Controller/actualizaBlog.php?id=<?=$articulo->getId()?>">Actualizar</a>
<a href="../Controller/borraBlog.php?id=<?=$articulo->getId()?>">Borrar</a>
<?php
}
?>
</body>
</html>