<?php
if (isset($_POST['registro'])) {
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    // Guardar en usuarios.dat
    file_put_contents('usuarios.dat', "$usuario,$contraseña\n", FILE_APPEND);
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
</head>
<body>
    <h1>Registrarse</h1>
    <form method="post">
        Usuario: <input type="text" name="usuario"><br>
        Contraseña: <input type="password" name="contraseña"><br>
        <input type="submit" name="registro" value="Registrarse">
    </form>
</body>
</html>