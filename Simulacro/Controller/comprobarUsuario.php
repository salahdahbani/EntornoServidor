<?php
session_start(); 
require_once '../Model/Usuario.php';
// Obtenemos los datos de forma segura
$nombre = $_POST['nombre'] ?? null;
if (!$nombre) {
    die("Datos incompletos");
}
$usuario = Usuario::getUsuarioByNombre($nombre);
// 2. Verificamos que el usuario exista y la contraseña coincida
if ($usuario && $usuario->getNombre() === $nombre) {
    
    // 3. GUARDAMOS LOS DATOS EN LA SESIÓN
    // Esto es lo que permite que 'index.php' reconozca al usuario
    $_SESSION['id_usuario'] = $usuario->getId();
    $_SESSION['nombre_usuario'] = $usuario->getNombre();

    
    header("Location: ../Controller/index.php");
    
} else {
    // 5. Manejo de error si los datos son incorrectos
    echo "Usuario no encontrado";
    header("Location: ../View/inicioSesion.php?error='Usuario no encontrado'");
}