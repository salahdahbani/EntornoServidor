<?php
session_start(); // Se inicia aquí UNA SOLA VEZ

require_once '../Model/Foto.php';
require_once '../Model/Usuario.php';
require_once '../Model/Like.php';


// Obtiene todas las asignaturas
$data['foto'] = Foto::getFotos();
// Obtiene todas las alumnos
$data['usuario'] = Usuario::getUsuarios(); 

include '../View/index_view.php';