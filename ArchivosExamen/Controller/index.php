<?php
$action = isset($_GET['action']) ? $_GET['action'] : 'listar';

switch ($action) {
    case 'listar':
        require_once 'listarAnimales.php';
        break;
    case 'formularioAgregar':
        require_once 'formularioNuevoAnimal.php';
        break;
    case 'guardarNuevo':
        require_once 'guardarNuevoAnimal.php';
        break;
    case 'añadir': // <--- Captura la acción del botón al lado del input numérico
        require_once 'añadirCantidad.php';
        break;
    case 'eliminar':
        require_once 'eliminarAnimal.php';
        break;
    case 'consultas':
        require_once 'consultas.php';
        break;
    case 'generarFichero':
        require_once 'generarFichero.php';
        break;
    default:
        require_once 'listarAnimales.php';
        break;
}