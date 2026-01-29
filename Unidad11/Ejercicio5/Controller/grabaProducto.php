<?php
require_once '../Model/Producto.php';
// sube la imagen al servidor
move_uploaded_file($_FILES["imagen"]["tmp_name"], "../View/images/" .$_FILES["imagen"]["name"]);
// inserta el producto en la base de datos
$productoAux = new Producto("", $_POST['nombre'], $_POST['precio'], $_POST['stock'],$_FILES["imagen"]["name"]);
$productoAux->insert();
header("Location: ../Controller/index.php");