<?php
require_once '../Model/Alumno.php';
$alumno=Alumno::getAlumnoById($_REQUEST['matricula']);
// actualiza el alumno en la base de datos
$alumnoAux = new Alumno($_REQUEST['matricula'], $_POST['nombre'], $_POST['apellidos'], $_POST['email']);
$alumnoAux->update();
header("Location: ../Controller/index_alumno.php");