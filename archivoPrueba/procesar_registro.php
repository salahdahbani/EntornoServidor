<?php
$usuario = trim($_POST['nuevo_usuario']);
$contrasena = trim($_POST['nueva_contrasena']);
$filename = "usuarios.dat";

if ($usuario && $contrasena) {
    $usuarios = file($filename, FILE_IGNORE_NEW_LINES);
    $existe = false;

    foreach ($usuarios as $linea) {
        list($user, ) = explode(':', $linea);
        if ($usuario === $user) {
            $existe = true;
            break;
        }
    }

    if (!$existe) {
        file_put_contents($filename, "$usuario:$contrasena\n", FILE_APPEND);
        echo "<p>Usuario registrado exitosamente.</p><a href='login.php'>Iniciar sesión</a>";
    } else {
        echo "<p style='color:red;'>El usuario ya existe.</p><a href='registrar.php'>Intentar de nuevo</a>";
    }
} else {
    echo "<p style='color:red;'>Por favor, completa todos los campos.</p><a href='registrar.php'>Volver</a>";
}
?>
