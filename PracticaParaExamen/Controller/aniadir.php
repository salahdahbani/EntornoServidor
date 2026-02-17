<?php
require_once '../Model/Ticket.php';

if (session_status() == PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../Controller/login.php");
    exit();
}

if(isset($_SESSION['usuario_id'])) {
    $id_usuario = $_SESSION['usuario_id'];
} else {
    die("Error: id_usuario no proporcionado.");
}
if ($id_usuario <= 0) {
    die("Error: id_usuario no válido. Asegúrate de estar logueado.");
}

$ticket = new Ticket(0,$_POST['descripcion'],'','pendiente', $id_usuario);
$ticket->insert();
header("Location: ../Controller/index.php");
exit();