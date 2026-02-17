<?php
require_once '../Model/Reserva.php';

session_start();

// Seguridad básica: si no hay sesión, al login
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Cogemos el id que viene por la URL
$id_reserva = $_GET['id_reserva'];

if (isset($id_reserva)) {
    // Si es admin borra cualquiera, si no, solo la suya
    if ($_SESSION['rol'] == 'admin') {
        Reserva::cancelarAdmin($id_reserva);
    } else {
        $id_u = $_SESSION['usuario_id'];
        Reserva::cancelar($id_reserva, $id_u);
    }
}

header("Location: index.php");