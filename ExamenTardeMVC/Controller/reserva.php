<?php
require_once '../Model/Reserva.php';

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Recogemos los datos del formulario
$id_sala = $_POST['id_sala'];
$fecha = $_POST['fecha'];
$turno = $_POST['turno'];
$id_user = $_SESSION['usuario_id'];

// Validamos que no falte nada importante
if ($id_sala != "" && $fecha != "" && $turno != "") {
    
    // Creamos el objeto reserva
    $reserva = new Reserva(0, $id_sala, $id_user, $fecha, $turno);
    
    // Intentamos guardar
    if ($reserva->insert()) {
        header("Location: index.php?mensaje=Reserva+confirmada");
    } else {
        // Si el insert falla (por ejemplo sala ocupada)
        header("Location: reserva_form.php?error=La+sala+ya+esta+ocupada");
    }

} else {
    header("Location: reserva_form.php?error=Faltan+datos");
}