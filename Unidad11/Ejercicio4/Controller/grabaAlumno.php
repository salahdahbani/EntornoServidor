<?php
require_once '../Model/Alumno.php';
// inserta el alumno en la base de datos
$alumnoAux = new Alumno($_POST['matricula'], $_POST['nombre'], $_POST['apellido'], $_POST['curso']);
$alumnoAux->insert();
header("Location: ../Controller/index_alumno.php");