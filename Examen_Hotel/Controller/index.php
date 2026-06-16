<?php
$action = isset($_GET['action']) ? $_GET['action'] : 'listar';

switch ($action) {
    case 'listar':
        require_once 'listarHabitaciones.php';
        break;
    case 'formularioAgregar':
        require_once 'formularioNuevaHabitacion.php';
        break;
    case 'guardarNuevo':
        require_once 'guardarNuevaHabitacion.php';
        break;
    case 'añadir': // <--- Captura la acción del botón al lado del input numérico
        require_once 'añadirCapacidad.php';
        break;
        case 'precio': // <--- Captura la acción del botón al lado del input numérico
        require_once 'añadirPrecio.php';
        break;
    case 'eliminar':
        require_once 'eliminarHabitacion.php';
        break;
    case 'consultas':
        require_once 'consultas.php';
        break;
    case 'generarFichero':
        require_once 'generarFichero.php';
        break;
    default:
        require_once 'listarHabitaciones.php';
        break;
}