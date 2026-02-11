<?php require_once '../Model/Asignatura.php';
require_once '../Model/Alumno.php';
require_once '../Model/Asignatura_Alumno.php';
// Obtiene todas las asignaturas
$data['asignatura'] = Asignatura::getAsignaturaById($_REQUEST['codigo_asignatura']);
// Obtiene todas las alumnos
$data['alumno'] = Asignatura_Alumno::getAlumnoMatriculados($_REQUEST['codigo_asignatura']);
// Carga la vista de listado
include '../View/alumnos_asignatura_view.php';