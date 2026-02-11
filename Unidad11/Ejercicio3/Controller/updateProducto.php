<?php
require_once '../Model/Producto.php';
$producto=Producto::getProductoById($_REQUEST['codigo']);
$imagen=$_REQUEST['imagenAnterior'];
if ($_FILES["imagen"]["name"]!="") {
// sube la imagen al servidor
move_uploaded_file($_FILES["imagen"]["tmp_name"], "../View/images/" .
$_FILES["imagen"]["name"]);
$imagen=$_FILES["imagen"]["name"];
}
// actualiza el producto en la base de datos
$productoAux = new Producto($_REQUEST['codigo'], $_POST['nombre'], $_POST['precio'], $_POST['stock'], $_POST['imagen']);
$productoAux->update();
header("Location: ../Controller/index.php");