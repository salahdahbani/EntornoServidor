<?php require_once '../Model/Alumno.php';
// Obtiene todas los alumnos
$data['alumno'] = Alumno::getAlumnos();
// Carga la vista de listado
include '../View/index_alumno_view.php';