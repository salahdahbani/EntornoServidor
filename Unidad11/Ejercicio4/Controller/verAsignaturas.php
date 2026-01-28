<?php
require_once '../Model/Alumno.php';
require_once '../Model/Asignatura.php';

$data['unAlumno'] = null;
$data['susAsignaturas'] = []; // Inicializamos como array vacío para evitar errores en la vista

if (isset($_GET['matricula'])) {
    $matricula = $_GET['matricula'];
    $alumno = Alumno::getAlumnoById($matricula);
    
    if ($alumno) {
        $data['unAlumno'] = $alumno;
        // Obtenemos las asignaturas en las que ya está inscrito
        $data['susAsignaturas'] = $alumno->getAsignaturaMat();
    }
}

include '../View/asignaturas_alumno_view.php';