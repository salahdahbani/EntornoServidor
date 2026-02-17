<?php
require_once '../Model/Sala.php';
require_once '../Model/Reserva.php';

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Pillamos todas las salas para que salgan en el desplegable (select)
$lista_salas = Sala::getAllSalas();
$nombre_usuario = $_SESSION['usuario'];

include '../View/reservas_view.php';