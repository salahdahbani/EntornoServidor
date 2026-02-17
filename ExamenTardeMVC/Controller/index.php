<?php
// 1. REVISA LAS MAYÚSCULAS AQUÍ. Si tu archivo es reserva.php, pon reserva.php
require_once '../Model/Reserva.php';
require_once '../Model/Sala.php';
require_once '../Model/Usuario.php';

session_start();

// Si no existe la sesión, mandamos al login
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// 2. Usamos isset() para evitar los Warnings si la sesión está vacía
if(isset($_SESSION['rol'])) {
    $mi_rol = $_SESSION['rol'];
} else {
    $mi_rol = 'usuario'; // Por defecto, por seguridad
}
if(isset($_SESSION['usuario_id'])) {
    $mi_id = $_SESSION['usuario_id'];
} else {
    $mi_id = -1; // Un ID que no existe, para evitar problemas
}
$nombre_user = $_SESSION['usuario'];


// 3. Obtener reservas (Cuidado con el nombre de la clase Reserva)
$lista_reservas = [];
if ($mi_rol == 'admin') {
    $lista_reservas = Reserva::getAllReservas();
} else {
$lista_reservas = Reserva::getReservasByUsuario($mi_id);
}

$datos_finales = [];
if ($lista_reservas) {
    foreach ($lista_reservas as $res) {
        $s = Sala::getSalaById($res->getIdSala());
        $u = Usuario::getUsuarioById($res->getIdUsuario());

        $datos_finales[] = [
            'id'     => $res->getId(),
            'sala'   => ($s) ? $s->getNombre() : 'Sala N/A',
            'usuario'=> ($u) ? $u->getNombre() : 'User N/A',
            'fecha'  => $res->getFecha(),
            'turno'  => $res->getTurno()
        ];
    }
}

include '../View/index_view.php';