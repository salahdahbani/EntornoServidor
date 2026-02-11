<?php
require_once '../Model/Asignatura.php';
// inserta la asignatura en la base de datos
$asignaturaAux = new Asignatura("", $_POST['nombre']);
$asignaturaAux->insert();
header("Location: ../Controller/index_asignatura.php");