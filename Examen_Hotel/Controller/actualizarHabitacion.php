<?php
require_once '../Model/Habitacion.php';

if (isset($_POST['id']) && isset($_POST['capacidad']) && isset($_POST['precio'])) {
    $animal = new Habitacion($_POST['id'], '', $_POST['precio'], $_POST['capacidad']);
    $animal->update();
}

// Redirección al controlador frontal
header('Location: index.php?action=listar');
exit;