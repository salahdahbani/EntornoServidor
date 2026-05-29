<?php
session_start();

if (!file_exists("usuarios.dat")) {
    file_put_contents("usuarios.dat", "admin:admin\n");
}

$recordado = $_COOKIE['usuario'] ?? '';
?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Login</title></head>
<body>
<h2>Login</h2>
<form method="POST" action="login.php">
    Usuario: <input type="text" name="usuario" value="<?= htmlspecialchars($recordado) ?>"><br>
    Contraseña: <input type="password" name="contrasena"><br>
    <label><input type="checkbox" name="recordar" <?= $recordado ? 'checked' : '' ?>> Recordar</label><br>
    <input type="submit" name="login" value="Entrar">
</form>
<a href="registrar.php">¿No tienes cuenta? Regístrate</a>

<?php
if (isset($_POST['login'])) {
    $usuario = $_POST['usuario'];
    $pass = $_POST['contrasena'];

    foreach (file("usuarios.dat", FILE_IGNORE_NEW_LINES) as $linea) {
        list($u, $p) = explode(":", $linea);
        if ($u === $usuario && trim($p) === $pass) {
            $_SESSION['usuario'] = $usuario;
            if (isset($_POST['recordar'])) setcookie("usuario", $usuario, time() + 604800);
            else setcookie("usuario", "", time() - 3600);
            header("Location: " . ($usuario === 'admin' ? 'admin.php' : 'notas.php'));
            exit;
        }
    }
    echo "<p style='color:red;'>Credenciales inválidas.</p>";
}
?>
</body>
</html>
