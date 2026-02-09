<?php
require_once 'Alumno.php';

$metodo = $_SERVER['REQUEST_METHOD'];
$codEstado = 200;
$mensaje = "OK";
$devolver = [];

if ($metodo == 'GET') {
    if (isset($_REQUEST['grupo'])) {
        // Asegúrate de que el método en Alumno.php sea getAlumnosPorCurso o getAlumnosFiltraCurso
        $alumnos = Alumno::getAlumnosFiltroCurso($_REQUEST['grupo']);
        foreach ($alumnos as $a) {
            $devolver[] = ['nombre' => $a->getNombre(), 'apellido' => $a->getApellido(), 'curso' => $a->getCurso()];
        }
    } else if (isset($_REQUEST['cadena'])) {
        $alumnos = Alumno::getAlumnosFiltroNombre($_REQUEST['cadena']);
        foreach ($alumnos as $a) {
            $devolver[] = ['nombre' => $a->getNombre(), 'apellido' => $a->getApellido(), 'curso' => $a->getCurso()];
        }
    } else if (isset($_REQUEST['nombre'])) { 
        $alumnoObj = Alumno::getAlumnooByNombre($_REQUEST['nombre']);
        if ($alumnoObj) {
            $asignaturas = $alumnoObj->getAsignaturaMat();
            foreach ($asignaturas as $asig) {
                $devolver[] = [
                    'codigo' => $asig->getCodigo(),
                    'nombre' => $asig->getNombre()
                ];
            }
        }
    }

    // El control de vacío debe estar DENTRO del bloque GET
    if (empty($devolver)) {
        $codEstado = 404;
        $mensaje = "NO SE ENCONTRARON RESULTADOS";
    }

} else if ($metodo == 'POST') {
    // Si envías matricula y codigo_asig es una MATRICULACIÓN
    if (isset($_REQUEST['matricula']) && isset($_REQUEST['codigo_asig'])) {
        // Aquí deberías tener una clase o método para insertar en asignatura_alumno
        // Ejemplo: Alumno::matricular($_REQUEST['matricula'], $_REQUEST['codigo_asig']);
        $mensaje = "MATRICULACIÓN REALIZADA";
    } else {
        // Es un INSERT de alumno nuevo
        $alumno = new Alumno(null, $_REQUEST['nombre'], $_REQUEST['apellido'], $_REQUEST['curso']);
        $alumno->insert();
        $mensaje = "ALUMNO INSERTADO";
    }

} else if ($metodo == 'PUT' || $metodo == 'UPDATE' || $metodo == 'DELETE') {
    parse_str(file_get_contents("php://input"), $parametros);
    $alumno = Alumno::getAlumnooByNombre($parametros['nombre']);
    
    if ($alumno) {
        if ($metodo == 'DELETE') {
            $alumno->delete();
            $mensaje = "ALUMNO BORRADO";
        } else {
            // Actualización de grupo
            $alumnoActualizado = new Alumno($alumno->getMatricula(), $alumno->getNombre(), $alumno->getApellido(), $parametros['curso']);
            $alumnoActualizado->update();
            $mensaje = "GRUPO ACTUALIZADO";
        }
    } else {
        $codEstado = 404;
        $mensaje = "ALUMNO NO ENCONTRADO";
    }
}

header("HTTP/1.1 $codEstado $mensaje");
header("Content-Type: application/json;charset=utf-8");
echo json_encode($devolver);