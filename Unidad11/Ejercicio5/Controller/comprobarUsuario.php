<?php
session_start(); 
require_once '../Model/Usuario.php';
// Obtenemos los datos de forma segura
$nombre = $_POST['nombre'] ?? null;
$pass = $_POST['pass'] ?? null;
if (!$nombre || !$pass) {
    die("Datos incompletos");
}
$usuario = Usuario::getUsuarioByNombre($nombre);
// 2. Verificamos que el usuario exista y la contraseña coincida
if ($usuario && $usuario->getPass() === $pass) {
    
    // 3. GUARDAMOS LOS DATOS EN LA SESIÓN
    // Esto es lo que permite que 'index_cliente.php' reconozca al usuario
    $_SESSION['id_usuario'] = $usuario->getId();
    $_SESSION['nombre_usuario'] = $usuario->getNombre();
    $_SESSION['rol'] = $usuario->getRol();

    // 4. Redirección según el rol
    if ($usuario->getRol() === "admin") {
        header("Location: ../Controller/index.php");
    } else {
        header("Location: ../Controller/index_cliente.php");
    }
} else {
    // 5. Manejo de error si los datos son incorrectos
    header("Location: ../View/login_view.php?error=1");
}