<?php
require_once '../Model/Asignatura_Alumno.php';

// Verificamos que lleguen los datos del enlace de la vista
if(isset($_GET['matricula']) && isset($_GET['codigo'])){
    $matricula = $_GET['matricula'];
    $codigo = $_GET['codigo'];
    // Creamos el objeto con los datos recibidos
    $relacion = new Asignatura_Alumno($matricula, $codigo);
    $relacion->insert();
}
// Redirigimos de vuelta a la ficha del alumno para ver los cambios
    header("Location: ../Controller/verAsignaturas.php?matricula=" . $matricula);
