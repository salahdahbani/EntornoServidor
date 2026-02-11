<?php
// Iniciar sesión si no está activa (aunque no es estrictamente necesario para registro)
if (session_status() == PHP_SESSION_NONE) session_start();

// Procesar el formulario cuando se envía
if (isset($_POST['añadir'])) {
    $user = trim($_POST['user']);  // Recortar espacios en blanco
    $passw = trim($_POST['pass']);

    // Validar que los campos no estén vacíos
    if (empty($user) || empty($passw)) {
        $error = "Por favor, complete todos los campos.";
    } else {
        // Verificar si el usuario ya existe
        $userExists = false;
        if (file_exists("usuarios.txt")) {
            $file = fopen("usuarios.txt", "r");
            while ($line = fgets($file)) {
                list($storedUser, $storedPass) = explode(',', trim($line));
                if ($user === $storedUser) {
                    $userExists = true;
                    break;
                }
            }
            fclose($file);
        }

        if ($userExists) {
            $error = "El usuario ya existe. Por favor, elija otro nombre de usuario.";
        } else {
            // Guardar en el archivo (solo una vez, sin loop redundante)
            $file = fopen("usuarios.txt", "a");  // Modo append
            fwrite($file, "$user,$passw" . PHP_EOL);  // Agregar nueva línea
            fclose($file);
            
            // Redirigir al login (corregido el caso de la letra)
            header('Location: Login.php');
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">  <!-- Cambié a 'es' para español -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
</head>
<body>
    <h1>Registro</h1>
    <form method="post">
        <label>Usuario:</label>
        <input type="text" name="user" required>  <!-- 'required' para validación básica en navegador -->
        <br>
        <label>Contraseña:</label>
        <input type="password" name="pass" required>
        <br>
        <input type="submit" name="añadir" value="Registrarse">
    </form>
      <br>
    <a href="Login.php">Volver al login</a>
    <!-- Mostrar errores si existen -->
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
</body>
</html>
