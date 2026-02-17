<?php
require_once '../Model/Usuario.php';

session_start();

// Si ya tiene sesión, va al index directamente
if (isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

$error = "";

// 1. LÓGICA DE LOGIN
if (isset($_POST['nombre']) && isset($_POST['password']) && !isset($_POST['registro'])) {
    $nombre = $_POST['nombre'];
    $pass   = $_POST['password'];

    $user = Usuario::getUsuarioByNombre($nombre);

    if ($user && $user->getPassword() == $pass) {
        $_SESSION['usuario']    = $user->getNombre();
        $_SESSION['usuario_id'] = $user->getId();
        $_SESSION['rol']        = $user->getRol();
        
        header("Location: index.php");
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}

// 2. LÓGICA DE REGISTRO
if (isset($_POST['registro'])) {
    $nombre = $_POST['nombre'];
    $pass   = $_POST['password'];
    
    // IMPORTANTE: Asegúrate de que este valor coincida con tu DB
    // Si tu DB usa ENUM, usa uno de los valores permitidos (ej: 'admin' o 'usuario')
    $rol = "client"; 

    if (Usuario::getUsuarioByNombre($nombre)) {
        $error = "El usuario ya existe.";
    } else {
        $nuevo_usuario = new Usuario(null, $nombre, $pass, $rol);
        $nuevo_usuario->insert();
        
        $user_creado = Usuario::getUsuarioByNombre($nombre);
        
        if ($user_creado) {
            $_SESSION['usuario']    = $user_creado->getNombre();
            $_SESSION['usuario_id'] = $user_creado->getId();
            $_SESSION['rol']        = $user_creado->getRol();
            header("Location: index.php");
            exit();
        }
    }
}

include '../View/login_view.php';