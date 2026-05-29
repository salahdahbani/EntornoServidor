<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nuevo = trim($_POST['nuevo_usuario']);
    $nueva_pass = trim($_POST['nueva_contrasena']);
    $usuarios = file("usuarios.dat", FILE_IGNORE_NEW_LINES);

    foreach ($usuarios as $user) {
        list($u, ) = explode(":", $user);
        if ($u === $nuevo) {
            echo "El usuario ya existe. <a href='login.php'>Volver</a>";
            exit;
        }
    }
    file_put_contents("usuarios.dat", "$nuevo:$nueva_pass\n", FILE_APPEND);
    echo "Registrado. <a href='login.php'>Inicia sesión</a>";
}
?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Registro</title></head>
<body>
<h2>Registrarse</h2>
<form method="POST">
    Usuario: <input type="text" name="nuevo_usuario"><br>
    Contraseña: <input type="password" name="nueva_contrasena"><br>
    <input type="submit" value="Registrar">
</form>
</body>
</html>
