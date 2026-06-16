<?php
require_once '../Model/Habitacion.php';

// Validamos que se reciba el ID y una cantidad válida a añadir
if (isset($_POST['id']) && isset($_POST['cantidad_sumar']) && $_POST['cantidad_sumar'] > 0) {
    $id = $_POST['id'];
    $unidadesASumar = intval($_POST['cantidad_sumar']);

    // 1. Obtener los datos actuales del animal desde la BD utilizando tu método estático
    $habitacionActual = Habitacion::getHabitacionById($id);

    if ($habitacionActual) {
        // 2. Calcular la nueva cantidad total (Actual + Lo que viene del input)
        $nuevaCapacidadTotal = $habitacionActual->getCapacidad() + $unidadesASumar;

        // 3. Reutilizamos el método update pasándole la cantidad total calculada y su comida original
        $habitacionActualizado = new Habitacion($id, $habitacionActual->getNumero(),$habitacionActual->getTipoId() ,$habitacionActual->getPrecio(),$nuevaCapacidadTotal,$habitacionActual->getTipo());
        $habitacionActualizado->update();

        $_SESSION['ultima_accion'] = "Añadidas " . $unidadesASumar . " unidades a " . $habitacionActual->getTipo() . ".";
    }
}

// Redireccionar al listado principal de forma limpia
header('Location: index.php?action=listar');
exit;