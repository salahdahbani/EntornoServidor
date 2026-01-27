<?php
require_once '../Model/Alumno.php';
$alumnoAux = new Alumno($_GET['matricula']);
$alumnoAux->delete();
header("Location: ../Controller/index_alumno.php");