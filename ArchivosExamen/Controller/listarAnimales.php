<?php
require_once '../Model/Animal.php';

// 1. Obtener los animales
$listaAnimales = Animal::getAnimales();

// 2. Calcular la especie más numerosa
$especieMasNumerosa = "Ninguna";
$maxCantidad = 0;

foreach ($listaAnimales as $animal) {
    if ($animal->getCantidad() > $maxCantidad) {
        $maxCantidad = $animal->getCantidad();
        $especieMasNumerosa = $animal->getEspecie();
    }
}
$ultimaAccion = isset($_SESSION['ultima_accion']) ? $_SESSION['ultima_accion'] : "Ninguna acción reciente.";

// 3. Cargar la vista de la tabla
require_once '../View/indexView.php';