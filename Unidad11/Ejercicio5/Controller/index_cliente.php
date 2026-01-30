<?php

require_once '../Model/Producto.php';
require_once '../Model/Usuario.php';
// Controller/index_cliente.php
session_start(); // Se inicia aquí UNA SOLA VEZ
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
}else{
    
    $data['usuario'] = Usuario::getUsuarioById($_SESSION['id_usuario']);
}


// Preparamos todos los datos que la vista va a necesitar
$data['productos'] = Producto::getProductos();


// Finalmente, cargamos la vista
include '../View/index_cliente_view.php';