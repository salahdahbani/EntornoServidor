<?php
require_once '../Model/Alumno.php';
// inserta el alumno en la base de datos
if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['curso'])) {
$alumnoAux = new Alumno($_POST['matricula'], $_POST['nombre'], $_POST['apellido'], $_POST['curso']);
$alumnoAux->insert();
header("Location: ../Controller/index.php");
}
