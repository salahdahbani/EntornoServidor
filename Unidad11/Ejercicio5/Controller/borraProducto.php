<?php
require_once '../Model/Producto.php';
$productoAux = new Producto($_GET['codigo']);
$productoAux->delete();
header("Location: ../Controller/index.php");