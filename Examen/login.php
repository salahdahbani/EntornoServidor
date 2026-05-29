<?php
if(session_status() === PHP_SESSION_NONE) {session_start();}

if (isset($_COOKIE['usuario']) && isset($_COOKIE['password'])) {
    $usuario = $_COOKIE['usuario'];
    $password = $_COOKIE['password'];
    $rutaFichero = $usuario . '.rsv';

    if (file_exists($rutaFichero)) {
        $archivo = fopen($rutaFichero, 'r');
        $linea = fgets($archivo);
        fclose($archivo);
        if ($password === trim($linea)) {
            $_SESSION['usuario'] = $usuario;
            header('Location: index.php');
            exit;
        }
    }
}

if (isset($_REQUEST['usuario']) && $_REQUEST['password']) {
    $usuario = $_REQUEST['usuario'];
    $password = $_REQUEST['password'];
    $rutaFichero = $usuario . '.rsv';

    if (isset($_REQUEST['registro'])) {
        if (!file_exists($rutaFichero)) {
            $archivo = fopen($rutaFichero, 'w');
            fwrite($archivo, $password . "\n");
            fclose($archivo);
            $_SESSION['usuario'] = $usuario;
            setcookie('usuario', $usuario, time() + 3600 * 24 * 30);
            setcookie('password', $password, time() + 3600 * 24 * 30);
            header('Location: index.php');
            exit;
        } else {
            $error = 'El usuario ya existe.';
        }
    } elseif (isset($_REQUEST['login'])) {
        if (file_exists($rutaFichero)) {
            $archivo = fopen($rutaFichero, 'r');
            $linea = fgets($archivo);
            fclose($archivo);
            if ($password === trim($linea)) {
                $_SESSION['usuario'] = $usuario;
                setcookie('usuario', $usuario, time() + 3600 * 24 * 30);
                setcookie('password', $password, time() + 3600 * 24 * 30);
                header('Location: index.php');
                exit;
            } else {
                $error = 'Contraseña incorrecta.';
            }
        } else {
            $error = 'El usuario no existe.';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Iniciar Sesión</h1>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>

    <h2>Iniciar Sesión</h2>
    <form method="POST">
        Usuario: <input type="text" name="usuario" required><br>
        Contraseña: <input type="password" name="password" required><br>
        <button type="submit" name="login">Iniciar Sesión</button>
    </form>

    <h2>Registrarse</h2>
    <form method="POST">
        Usuario: <input type="text" name="usuario" required><br>
        Contraseña: <input type="password" name="password" required><br>
        <button type="submit" name="registro">Registrarse</button>
    </form>
</body>
</html>
