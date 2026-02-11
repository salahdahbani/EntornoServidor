<?php
require_once '../Model/Producto.php';
$data['producto']=Producto::getProductoById($_REQUEST['codigo']);
// Carga la vista del formulario de alta de producto
include '../View/actualizaProducto_view.php';