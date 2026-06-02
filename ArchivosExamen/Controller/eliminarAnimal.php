<?php
session_start();
require_once '../Model/Animal.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $animalActual = Animal::getAnimalById($id);

    if ($animalActual) {
        $nombreEspecie = $animalActual->getEspecie();
        
        $animalBorrar = new Animal($id);
        $animalBorrar->delete();

        // 💡 GUARDAMOS LA ACCIÓN EN LA SESIÓN
        $_SESSION['ultima_accion'] = "Eliminado/a " . $nombreEspecie . " de la granja (ID: " . $id . ").";
    }
}

header('Location: index.php?action=listar');
exit;