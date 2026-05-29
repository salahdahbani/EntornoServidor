<?php
session_start();

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];
$recordar = isset($_POST['recordar']);

$usuarios = file("usuarios.dat", FILE_IGNORE_NEW_LINES);
$valido = false;

foreach ($usuarios as $linea) {
    list($user, $pass) = explode(':', $linea);
    if ($usuario === $user && $contrasena === trim($pass)) {
        $valido = true;
        break;
    }
}

if ($valido) {
    $_SESSION['usuario'] = $usuario;

    if ($recordar) {
        setcookie('usuario', $usuario, time() + (7 * 24 * 60 * 60)); // 1 semana
    } else {
        setcookie('usuario', '', time() - 3600);
    }

    echo "<p>Bienvenido, $usuario</p><a href='login.php'>Volver</a>";
} else {
    echo "<p style='color:red;'>Usuario o contraseña incorrectos.</p><a href='login.php'>Intentar de nuevo</a>";
}
