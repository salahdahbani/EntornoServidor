<?php
require_once '../Model/Animal.php';

if (!empty($_POST['especie']) && isset($_POST['cantidad'])) {
    $nuevoAnimal = new Animal(0, $_POST['especie'], $_POST['cantidad'], $_POST['comida']);
    $nuevoAnimal->insert();

    $_SESSION['ultima_accion'] = "Registrado nuevo animal (" . $_POST['especie'] . ") con " . $_POST['cantidad'] . " uds.";
}

// Redirección al controlador frontal para refrescar la lista
header('Location: index.php?action=listar');
exit;