<?php
require_once '../Model/Asignatura.php';
$asignatura=Asignatura::getAsignaturaById($_REQUEST['codigo']);
// actualiza la asignatura en la base de datos
$asignaturaAux = new Asignatura($_REQUEST['codigo'], $_POST['nombre']);
$asignaturaAux->update();
header("Location: ../Controller/index_asignatura.php");