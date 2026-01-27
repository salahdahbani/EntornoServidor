<?php
require_once '../Model/Articulo.php';
$articulo=Articulo::getArticuloById($_REQUEST['id']);
// actualiza el artículo en la base de datos
$articuloAux = new Articulo($_REQUEST['id'], $_POST['titulo'], date("Y-m-d"), $_POST['contenido']);
$articuloAux->update();
header("Location: ../Controller/index.php");