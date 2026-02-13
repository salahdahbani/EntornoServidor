<?php
session_start(); // Se inicia aquí UNA SOLA VEZ

require_once '../Model/Foto.php';
require_once '../Model/Usuario.php';
require_once '../Model/Like.php';


// Obtiene todas las asignaturas
$data['foto'] = Foto::getFotos();
// Obtiene todas las alumnos
$data['usuario'] = Usuario::getUsuarios(); 

if (isset($_SESSION['id_usuario'])) {
    // Suponiendo que tienes un método que devuelva los IDs de fotos votadas por ese usuario
    // Ejemplo: [1, 4, 12]
    $data['likes_usuario'] = Like::getLikeByUsuario($_SESSION['id_usuario']);
}

include '../View/index_view.php';