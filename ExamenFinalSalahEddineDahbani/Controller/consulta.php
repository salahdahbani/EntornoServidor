<?php
require_once '../Model/Coche.php';
if(session_status() == PHP_SESSION_NONE) session_start();

if(!isset($_SESSION['concesionario'])){
    header("Location: login.php");
    exit();
}

// Capturamos el término si se ha escrito algo en el input
$busqueda = isset($_REQUEST['busqueda']) ? trim($_REQUEST['busqueda']) : '';

$todosLosCoches = Coche::getCoches();
$listaCoches = [];

// Si hay texto, filtramos las sílabas; si no, listamos todo
if ($busqueda !== '') {
    foreach ($todosLosCoches as $coche) {
        if (mb_stripos($coche->getconcesionario(), $busqueda) !== false) {
            $listaCoches[] = $coche;
        }
    }
} else {
    $listaCoches = $todosLosCoches;
}

// Cargamos la vista de consultas
require_once '../View/indexView.php';