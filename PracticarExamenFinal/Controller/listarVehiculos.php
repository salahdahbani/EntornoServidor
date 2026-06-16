<?php
session_start();
require_once '../Model/Vehiculo.php';
require_once '../Model/Categoria.php';

// 1. Obtener los vehículos
$listaVehiculos = Vehiculo::getVehiculos();
$listaCategorias = Categoria::getCategorias();

if (!isset($_SESSION['cantidad'])) {
    $_SESSION['cantidad'] = [];
}

$conteoCategorias = [];
// 2. Calcular la categoría más numerosa
$categoriaMasNumerosa = "Ninguna";
$maxCantidad = 0;

foreach ($listaVehiculos as $vehiculo) {
    $idVehiculo = $vehiculo->getId();
    $nomCategoria = $vehiculo->getCategoria(); // Asumiendo que devuelve el nombre o ID de la categoría
    
    // Si este vehículo tiene unidades guardadas en la sesión, las sumamos al total de su categoría
    if (isset($_SESSION['cantidad'][$idVehiculo])) {
        if (!isset($conteoCategorias[$nomCategoria])) {
            $conteoCategorias[$nomCategoria] = 0;
        }
        $conteoCategorias[$nomCategoria] += $_SESSION['cantidad'][$idVehiculo];
    }
}

foreach ($conteoCategorias as $categoria => $numeroVehiculos ) {
    
    if ($numeroVehiculos > $maxCantidad ) {
        $maxCantidad = $numeroVehiculos;
        $categoriaMasNumerosa = $categoria;
    }
}
$cantidadSumar = isset($_SESSION['cantidad']) ? $_SESSION['cantidad'] : "Ninguna cantidad añadida.";
$ultimaAccion = isset($_SESSION['ultima_accion']) ? $_SESSION['ultima_accion'] : "Ninguna acción reciente.";

// 3. Cargar la vista de la tabla
require_once '../View/indexView.php';