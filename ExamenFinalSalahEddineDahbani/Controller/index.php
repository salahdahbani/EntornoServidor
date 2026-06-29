<?php
if(session_status() == PHP_SESSION_NONE) session_start();
$action = isset($_GET['action']) ? $_GET['action'] : 'listar';


if(!isset($_SESSION['concesionario'])){
    $_SESSION['concesionario']=[]; 
}

$tiempo = date("d/m/Y H:i:s") . "+" . $_SESSION['concesionario']['concesionario'];
    setcookie("acceso",$tiempo, time() + 3600*24*30*3);
   
 if (isset($_COOKIE["acceso"])) {
$tiempo = $_COOKIE["acceso"];
}


switch ($action) {
    case 'login':
        require_once 'login.php';
        break;
    case 'listar':
        require_once 'listarCoches.php';
        break;
    case 'formularioAgregar':
        require_once 'formularioNuevoCoche.php';
        break;
    case 'guardarNuevo':
        require_once 'guardarNuevoCoche.php';
        break;
     case 'salir': 
        require_once 'logout.php';
        break;
    case 'eliminar':
        require_once 'eliminarCoche.php';
        break;
    case 'consultas':
        require_once 'consulta.php';
        break;
    // case 'generarFichero':
    //     require_once 'generarFichero.php';
    //     break;
    default:
        require_once 'listarCoches.php';
        break;
}