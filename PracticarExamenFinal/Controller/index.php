<?php

$action = isset($_GET['action']) ? $_GET['action'] : 'listar';

switch ($action) {
    case 'listar':
        require_once 'listarVehiculos.php';
        break;
    case 'formularioAgregar':
        require_once 'formularioNuevoVehiculo.php';
        break;
    case 'guardarNuevo':
        require_once 'guardarNuevoVehiculo.php';
        break;
    case 'añadir': // <--- Captura la acción del botón al lado del input numérico
        require_once 'actualizarEstado.php';
        break;
    case 'eliminar':
        require_once 'eliminarVehiculo.php';
        break;
    case 'consultas':
        require_once 'consulta.php';
        break;
    case 'generarFichero':
        require_once 'generarFichero.php';
        break;
    default:
        require_once 'listarVehiculos.php';
        break;
}