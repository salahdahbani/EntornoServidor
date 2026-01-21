<?php require_once '../Model/banco.php';
// Obtiene todos los clientes
$data['clientes'] = banco::getClientes();
// Carga la vista de listado
include '../View/index_view.php';
?>