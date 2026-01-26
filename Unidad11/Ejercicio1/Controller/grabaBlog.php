<?php
require_once '../Model/Articulo.php';
// inserta el artículo en la base de datos
$blogAux = new Articulo("", $_POST['titulo'], date("Y-m-d"), $_POST['contenido']);
$blogAux->insert();
header("Location: ../Controller/index.php");