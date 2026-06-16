<?php
session_start();
require_once '../Model/Habitacion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $habitacionActual = Habitacion::getHabitacionById($id);

    if ($habitacionActual) {
        $nombreTipo = $habitacionActual->getTipo();
        
        $habitacionBorrar = new Habitacion($id);
        $habitacionBorrar->delete();

        // 💡 GUARDAMOS LA ACCIÓN EN LA SESIÓN
        $_SESSION['ultima_accion'] = "Eliminado/a " . $nombreTipo . " de la granja (ID: " . $id . ").";
    }
}

header('Location: index.php?action=listar');
exit;