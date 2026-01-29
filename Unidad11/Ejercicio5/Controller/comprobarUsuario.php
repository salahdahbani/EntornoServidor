<?php
require_once '../Model/Usuario.php';

if (isset($_POST['nombre'])) {
    $nombre = $_POST['nombre'];
} else {
    $nombre = null;
}
if (isset($_POST['pass'])) {
    $pass = $_POST['pass'];
} else {
    $pass = null;
}

if ($nombre === null || $pass === null) {
    echo "Datos incompletos";
}

$usuario = Usuario::getUsuarioByNombre($nombre);
$usuario->getId();

if ($usuario->getNombre() === $nombre && $usuario->getPass() === $pass) {
    if ($usuario->getRol() === "admin") {
        header("Location: ../Controller/index.php");
    } else {
        header("Location: ../Controller/index_cliente.php");
    }
} else {
    echo "Usuario o contraseña incorrectos";
}
