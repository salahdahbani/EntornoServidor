<?php
require_once '../Model/Alumno.php';
$alumno=Alumno::getAlumnoById($_REQUEST['matricula']);
// actualiza el alumno en la base de datos
$alumnoAux = new Alumno($_REQUEST['matricula'], $_POST['nombre'], $_POST['apellido'], $_POST['curso']);
$alumnoAux->update();
header("Location: ../Controller/index.php");