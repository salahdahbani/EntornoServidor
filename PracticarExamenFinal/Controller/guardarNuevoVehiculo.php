<?php
session_start();

require_once '../Model/Vehiculo.php';

if (!empty($_POST['categoria']) && isset($_POST['disponible'])) {
    $nuevoVehiculo = new Vehiculo( $_POST['id'],$_POST['modelo'], $_POST['categoria'], $_POST['disponible']);
    $nuevoVehiculo->insert();

    $_SESSION['ultima_accion'] = "Registrado nuevo vehiculo (" . $_POST['categoria'] . ") estado " . $_POST['disponible'] . " ";
}

// Redirección al controlador frontal para refrescar la lista
header('Location: index.php?action=listar');
exit;