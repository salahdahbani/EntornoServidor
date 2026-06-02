<?php
require_once '../Model/Animal.php';

if (isset($_POST['id']) && isset($_POST['cantidad'])) {
    $animal = new Animal($_POST['id'], '', $_POST['cantidad'], $_POST['comida']);
    $animal->update();
}

// Redirección al controlador frontal
header('Location: index.php?action=listar');
exit;