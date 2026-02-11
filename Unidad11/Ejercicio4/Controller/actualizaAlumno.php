<?php
require_once '../Model/Alumno.php';
$data['alumno']=Alumno::getAlumnoById($_REQUEST['matricula']);
// Carga la vista del formulario de alta de alumno
include '../View/actualizaAlumno_view.php';