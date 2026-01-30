<?php require_once '../Model/Usuario.php';
// Obtiene todos los usuarios
$data['usuario'] = Usuario::getUsuarios();
// Carga la vista de listado
include '../View/inicioSesion.php';