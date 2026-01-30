<?php require_once '../Model/Producto.php';
require_once '../Model/Usuario.php';
session_start();
// Obtiene la cesta del usuario actual
// Obtiene todas los productos
$data['producto'] = Producto::getProductos();
if (isset($_SESSION['id_usuario'])) {
    $data['usuario'] = Usuario::getUsuarioById($_SESSION['id_usuario']);
}
// Carga la vista de listado
include '../View/carrito_view.php';