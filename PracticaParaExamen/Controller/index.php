<?php
require_once '../Model/Ticket.php';
require_once '../Model/Usuario.php';

if (session_status() == PHP_SESSION_NONE) session_start();

// 1. Lógica de cierre de sesión
if (isset($_REQUEST['cerrar'])) {
    session_destroy(); // Es más seguro destruir la sesión completa
    header("Location: ../Controller/login.php");
    
}

// 2. Comprobar si hay sesión ANTES de cargar datos
if (!isset($_SESSION['usuario'])) {
    header("Location: ../Controller/login.php");
}

$Roles = Usuario::getUsuarios();

// 3. Cargar datos solo si estamos logueados
$tickets = Ticket::getAllTickets();
$data['tickets'] = [];

foreach ($tickets as $ticket) {
    $autor = Usuario::getUsuarioById($ticket->getId_usuario());
    $data['tickets'][] = [
        'id' => $ticket->getId(),
        'descripcion' => $ticket->getDescripcion(),
        'autor' => $autor,
        'estado' => $ticket->getEstado()
    ];
}


// Obtener el ID del usuario logueado para pasarlo a la vista
$usuarioLogueado = Usuario::getUsuarioByNombre($_SESSION['usuario']);
if ($usuarioLogueado) {
    $data['id_usuario'] = $usuarioLogueado->getId();
    $data['nombre_usuario'] = $usuarioLogueado->getNombre();
    $data['rol'] = $usuarioLogueado->getRol();

    // 4. Redirección según el rol
    if ($usuarioLogueado->getRol() === "tecnico") {
    $usuario= new Usuario(null, $_REQUEST['usuario'], $_REQUEST['rol']);
    $ticket= Ticket::getAllTickets();
        header("Location: ../Controller/index_admin.php");
    }
    }

// 4. Cargar la vista
include '../View/index_view.php';