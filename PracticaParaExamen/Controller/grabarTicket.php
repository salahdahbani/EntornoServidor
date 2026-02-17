<?php
require_once '../Model/Ticket.php';
session_start();

// Verificar que hay sesión activa
if (!isset($_SESSION['id_usuario'])) {
    die("Error: No hay usuario autenticado en sesión.");
}

$id_usuario = $_SESSION['id_usuario'];
$ticketAux = new Ticket("", $_POST['descripcion'], $_POST['estado'], $_POST['id_usuario']);
$ticketAux->insert();
header("Location: ../Controller/index.php");