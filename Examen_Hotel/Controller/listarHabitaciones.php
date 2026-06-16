<?php
require_once '../Model/Habitacion.php';

// 1. Obtener los animales
$listaHabitaciones = Habitacion::getHabitaciones();

// 2. Calcular la especie más numerosa
$tipoMasEspaciosa = "Ninguna";
$maxCantidad = 0;

foreach ($listaHabitaciones as $hab) {
    if ($hab->getCapacidad() > $maxCantidad) {
        $maxCantidad = $hab->getCapacidad();
        $tipoMasNumerosa = $hab->getTipo();
    }
}
$ultimaAccion = isset($_SESSION['ultima_accion']) ? $_SESSION['ultima_accion'] : "Ninguna acción reciente.";

// 3. Cargar la vista de la tabla
require_once '../View/indexView.php';