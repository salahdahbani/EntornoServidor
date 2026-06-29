<?php
session_start();
require_once '../Model/Coche.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $cocheActual = Coche::getCocheById($id);

    if ($cocheActual) {
        $nombreCoche = $cocheActual->getmodelo();
        $nombreConcesionario = $cocheActual->getconcesionario();
        
        $cocheBorrar = new Coche($id);
        $cocheBorrar->delete();

        //GUARDAMOS LA ACCIÓN EN LA SESIÓN
        $_SESSION['ultima_accion'] = "Eliminado/a " . $nombreCoche . " del concesionario " . $nombreConcesionario . ".";
    }
}

header('Location: index.php?action=listar');
exit;