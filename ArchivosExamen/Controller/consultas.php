<?php
require_once '../Model/Animal.php';

// Capturamos el término si se ha escrito algo en el input
$busqueda = isset($_REQUEST['busqueda']) ? trim($_REQUEST['busqueda']) : '';

$todosLosAnimales = Animal::getAnimales();
$animalesFiltrados = [];

// Si hay texto, filtramos las sílabas; si no, listamos todo
if ($busqueda !== '') {
    foreach ($todosLosAnimales as $animal) {
        if (mb_stripos($animal->getEspecie(), $busqueda) !== false) {
            $animalesFiltrados[] = $animal;
        }
    }
} else {
    $animalesFiltrados = $todosLosAnimales;
}

// Cargamos la vista de consultas
require_once '../View/consultasView.php';