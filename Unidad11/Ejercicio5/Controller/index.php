<?php
session_start(); // Se inicia aquí UNA SOLA VEZ

require_once '../Model/Producto.php';
require_once '../Model/Usuario.php';

// Preparamos todos los datos que la vista va a necesitar
$data['productos'] = Producto::getProductos();

if (isset($_SESSION['id_usuario'])) {
    $data['usuario'] = Usuario::getUsuarioById($_SESSION['id_usuario']);
}

// Finalmente, cargamos la vista
include '../View/index_view.php';