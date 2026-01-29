<?php
// Carga la vista del formulario de alta de alumno
 require_once '../Model/Asignatura.php';
require_once '../Model/Alumno.php';
require_once '../Model/Asignatura_Alumno.php';

// Obtiene todas las asignaturas
$data['asignaturas'] = Asignatura::getAsignaturas();
$data['asignatura_alumno'] = Asignatura_Alumno::getAsignaturas();
if (isset($_REQUEST['matricula'])) {
    $matricula = $_REQUEST['matricula'];

    if ($matricula != '') { // comprobación simple sin empty
        $alumno = Alumno::getAlumnoById($matricula);

        if ($alumno) {
            $data['unAlumno'] = $alumno;
            $data['susAsignaturas'] = $alumno->getAsignaturaMat();
            $data['asignatura_libres'] = Asignatura_Alumno::getAsignaturaLibres($matricula);
        }
    }
}
// Si se envía código de asignatura
if (isset($_REQUEST['codigo_asignatura'])) {
    $codigo_asignatura = $_REQUEST['codigo_asignatura'];

    if ($codigo_asignatura != '') { // comprobación simple
        // Buscar la asignatura en el array de asignaturas
        $asignatura = null;
        foreach ($data['asignaturas'] as $a) {
            if ($a->getCodigo() == $codigo_asignatura) {
                $asignatura = $a;
                break;
            }
        }

        if ($asignatura) {
            $data['alumnos_matriculados'] = Asignatura_Alumno::getAlumnoMatriculados($codigo_asignatura);
        }
    }
}
// Obtiene todas las alumnos
$data['alumno'] = Alumno::getAlumnos();
$nombre = $data['asignaturas'][0]->getNombre();
$codigo = $data['asignaturas'][0]->getCodigo();
include '../View/nuevoMatricula_view.php';
