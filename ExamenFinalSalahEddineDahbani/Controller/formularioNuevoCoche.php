<?php
require_once '../Model/Coche.php';
if(session_status() == PHP_SESSION_NONE) session_start();

if(!isset($_SESSION['concesionario'])){
    header("Location: login.php");
    exit();
}

$nombreCiudades =["Utrera","Palacios","DosHermanas","Moron","Guadalema","Arahal","Sevilla"];



if(isset($_POST['entrar'])){
$concesionario = $_POST['concesionario'];
$datos = "$concesionario";
$_SESSION['concesionario']=[
    'concesionario'=> $concesionario
];
}

// 1. Obtener los vehículos
$listaCoches = Coche::getCoches();


require_once '../View/nuevoCoche.php';

?>