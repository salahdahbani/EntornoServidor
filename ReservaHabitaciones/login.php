<?php
session_start();

// Si el usuario ya está autenticado, redirige a la página principal
if (isset($_SESSION['usuario'])) {
    header('Location: principal.php');
    exit();
}

// Si hay una cookie de "Recordar contraseña", rellena el formulario
$usuarioGuardado = '';
$contraseñaGuardada = '';
if (isset($_COOKIE['usuario']) && isset($_COOKIE['contraseña'])) {
    $usuarioGuardado = $_COOKIE['usuario'];
    $contraseñaGuardada = $_COOKIE['contraseña'];
}

// Procesar el formulario de login
if (isset($_POST['login'])) {
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    // Verificar las credenciales
    if (validarUsuario($usuario, $contraseña)) {
        $_SESSION['usuario'] = $usuario;

        // Guardar en cookies si el checkbox está marcado
        if (isset($_POST['recordar'])) {
            setcookie('usuario', $usuario, time() + 30 * 24 * 3600); // 1 mes
            setcookie('contraseña', $contraseña, time() + 30 * 24 * 3600);
        } else {
            // Eliminar las cookies si no se marca el checkbox
            setcookie('usuario', '', time() - 3600);
            setcookie('contraseña', '', time() - 3600);
        }

        header('Location: principal.php');
        exit();
    } else {
        echo "Usuario o contraseña incorrectos.";
    }
}

// Función para validar usuarios
function validarUsuario($usuario, $contraseña) {
    $usuarios = file('usuarios.dat', FILE_IGNORE_NEW_LINES);
    foreach ($usuarios as $linea) {
        list($user, $pass) = explode(',', $linea);
        if ($user === $usuario && $pass === $contraseña) {
            return true;
        }
    }
    return false;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Iniciar Sesión</h1>
    <form method="post">
        Usuario: <input type="text" name="usuario" value="<?= $usuarioGuardado ?>"><br>
        Contraseña: <input type="password" name="contraseña" value="<?= $contraseñaGuardada ?>"><br>
        Recordar contraseña: <input type="checkbox" name="recordar"><br>
        <input type="submit" name="login" value="Iniciar sesión">
    </form>
    <a href="registro.php">Registrarse</a>
</body>
</html>