<?php require_once '../Model/Articulo.php';
// Obtiene todas las ofertas
$data['articulo'] = Articulo::getArticulos();
// Carga la vista de listado
include '../View/index_view.php';