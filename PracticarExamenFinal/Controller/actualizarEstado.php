<?php
session_start();
require_once '../Model/Vehiculo.php';

// CORRECCIÓN: Inicializamos como array vacío, no como un entero (0)
if (!isset($_SESSION['cantidad'])) {
    $_SESSION['cantidad'] = [];
}

// Validamos que se reciba el ID y una cantidad válida a añadir
if (isset($_POST['id']) && isset($_POST['cantidad_sumar']) && (int)$_POST['cantidad_sumar'] > 0) {
    $id = $_POST['id'];
    $cantidadAniadida = (int)$_POST['cantidad_sumar'];

    // 1. Obtener los datos actuales del vehículo desde la BD
    $vehiculoActual = Vehiculo::getVehiculoById($id);

    if ($vehiculoActual) {
        // 2. Si este ID específico no tenía cantidad asignada en el array, lo inicializamos en 0
        if (!isset($_SESSION['cantidad'][$id])) {
            $_SESSION['cantidad'][$id] = 0;
        }

        // Acumulamos la cantidad en el ID correspondiente
        $_SESSION['cantidad'][$id] += $cantidadAniadida;

        // 3. REGISTRAMOS LA ÚLTIMA ACCIÓN
        $_SESSION['ultima_accion'] = "Se han añadido " . $cantidadAniadida . " uds del vehículo " . $vehiculoActual->getModelo() . " (" . $vehiculoActual->getCategoria() . ").";
    }
}

// Redireccionar al listado principal de forma limpia
header('Location: index.php?action=listar');
exit;