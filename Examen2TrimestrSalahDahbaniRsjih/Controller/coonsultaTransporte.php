<?php
require_once '../Model/Ciudad.php';
require_once '../Model/Transporte.php';

// 2. Necesitas las ciudades para los select del formulario superior
$ciudades = Ciudad::getCiudades();

// 3. Inicializa transportes
$transportes = [];

if (isset($_POST['filtraNombre']) && !empty($_POST['empresa'])) {
    // Simplemente pasamos el texto recibido del formulario
    $nombre = $_POST['empresa']; 
    $transportes = Transporte::getTransporteFiltroNombre($nombre);
} else {
    $transportes = Transporte::getTransportes(); 
}

// 4. Carga la vista
include '../View/filtrar_view.php';