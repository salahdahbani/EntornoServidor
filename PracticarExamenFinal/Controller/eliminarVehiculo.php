<?php
session_start();
require_once '../Model/Vehiculo.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $vehiculoActual = Vehiculo::getVehiculoById($id);

    if ($vehiculoActual) {
        $nombreCategoria = $vehiculoActual->getCategoria();
        
        $vehiculoBorrar = new Vehiculo($id);
        $vehiculoBorrar->delete();

        // 💡 GUARDAMOS LA ACCIÓN EN LA SESIÓN
        $_SESSION['ultima_accion'] = "Eliminado/a " . $nombreCategoria . " de la granja (ID: " . $id . ").";
    }
}

header('Location: index.php?action=listar');
exit;