<?php
require_once '../Model/Vehiculo.php';

// Capturamos el término si se ha escrito algo en el input
$busqueda = isset($_REQUEST['busqueda']) ? trim($_REQUEST['busqueda']) : '';

$todosLosVehiculos = Vehiculo::getVehiculos();
$vehiculosFiltrados = [];

// Si hay texto, filtramos las sílabas; si no, listamos todo
if ($busqueda !== '') {
    foreach ($todosLosVehiculos as $vehiculo) {
        if (mb_stripos($vehiculo->getModelo(), $busqueda) !== false) {
            $vehiculosFiltrados[] = $vehiculo;
        }
    }
} else {
    $vehiculosFiltrados = $todosLosVehiculos;
}

// Cargamos la vista de consultas
require_once '../View/consultasView.php';