<?php
// Carga la vista del formulario de alta de alumno
 require_once '../Model/Asignatura.php';
require_once '../Model/Alumno.php';
require_once '../Model/Asignatura_Alumno.php';

// Obtiene todas las asignaturas
$data['asignatura_alumno'] = Asignatura_Alumno::getAsignaturas();
if(isset($_REQUEST['matricula'])){
    $matricula = $_REQUEST['matricula'];

    if ($matricula) {
  $alumno = Alumno::getAlumnoById($matricula);
    if ($alumno) {
        $data['unAlumno'] = $alumno;
        $data['susAsignaturas'] = $alumno->getAsignaturaMat();
    }
    }
    $data['unAlumno'] = Alumno::getAlumnoById($matricula);
    
    // Esto ahora devuelve un array de objetos Asignatura_Alumno
    $data['asignatura_libres'] = Asignatura_Alumno::getAsignaturaLibres($matricula);
}
// Obtiene todas las asignaturas
if(isset($_REQUEST['codigo_asignatura'])){
    $codigo_asignatura = $_REQUEST['codigo_asignatura'];
$data['alumnos_matriculados'] = Asignatura_Alumno::getAlumnoMatriculados($codigo_asignatura);
}
// Obtiene todas las alumnos
$data['alumno'] = Alumno::getAlumnos();
// Carga la vista de listado
include '../View/nuevoMatricula_view.php';