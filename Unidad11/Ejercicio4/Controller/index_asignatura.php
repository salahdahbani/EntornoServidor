<?php require_once '../Model/Asignatura.php';
// Obtiene todas las asignaturas
$data['asignatura'] = Asignatura::getAsignaturas();
// Carga la vista de listado
include '../View/index_asignatura_view.php';