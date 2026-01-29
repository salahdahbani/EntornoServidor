<?php require_once '../Model/Producto.php';
// Obtiene todas los productos
$data['producto'] = Producto::getProductos();
// Carga la vista de listado
include '../View/index_cliente_view.php';