<?php
require_once '../Model/Asignatura.php';
$asignaturaAux = new Asignatura($_GET['codigo']);
$asignaturaAux->delete();
header("Location: ../Controller/index_asignatura.php");