<?php
if(session_status() == PHP_SESSION_NONE) session_start();
require_once '../Model/Coche.php';
//Inicializamos la sesion
if(!isset($_SESSION['concesionario'])){
    $_SESSION['concesionario']=[]; 
}


// 1. Obtener los vehículos
$listaCoches = Coche::getCoches();


$ultimaAccion = isset($_SESSION['ultima_accion']) ? $_SESSION['ultima_accion'] : "Ninguna acción reciente.";

// 3. Cargar la vista de la tabla
require_once '../View/indexView.php';