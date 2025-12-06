<?php
if (session_status() == PHP_SESSION_NONE) session_start();

// Function to validate user (now actually used)
function validarUsuario($usuario, $contrasena) {
    if (!file_exists("usuarios.txt")) {
        return false;
    }
    $lineas = file("usuarios.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lineas as $linea) {
        list($user, $pass) = explode(',', trim($linea));
        if ($usuario === trim($user) && $contrasena === trim($pass)) {
            return true;
        }
    }
    return false;
}

// Check if already logged in
if (isset($_SESSION['user']) || isset($_COOKIE['user'])) {
    if (isset($_COOKIE['user'])) {
        $_SESSION['user'] = $_COOKIE['user'];
    }
    echo "Bienvenido " . $_SESSION['user'];

    // Logout
    if (isset($_POST['logout'])) {
        session_destroy();
        setcookie("user", "", -1);
        header("Location: Login.php");
        exit();
    }

    // Save cookies
    if (isset($_POST['guardarCookies'])) {
        setcookie("user", $_SESSION['user'], time() + 3*24*3600);
        header("Location: Login.php");
        exit();
    }

    // Show logout/cookie forms
    ?>
    <form action="" method="post">
        <input type="submit" name="logout" value="Cerrar sesión">
    </form>
    <form action="" method="post">
        <input type="submit" name="guardarCookies" value="Guardar cookies">
    </form>
    <?php
} else {
    // Handle login attempt
    if (isset($_POST['user']) && isset($_POST['pass'])) {
        $user = trim($_POST['user']);
        $pass = trim($_POST['pass']);
        if (validarUsuario($user, $pass)) {
            $_SESSION['user'] = $user;
            echo "Has iniciado sesión. Bienvenido " . $user;
            // Optionally redirect or show forms here
        } else {
            $error = "Usuario o contraseña incorrectos.";
        }
    }

    // Show login form
    ?>
    <form method="post">
        <label>Usuario:</label>
        <input type="text" name="user" required>
        <br>
        <label>Contraseña:</label>
        <input type="password" name="pass" required>
        <br>
        <input type="submit" value="Entrar">
    </form>
    <form method="post">
        <input type="submit" name="registrarse" value="Registrarse">
    </form>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
  
    <?php
}

// Handle registration redirect
if (isset($_POST['registrarse'])) {
    header("Location: registrarse.php");
    exit();
}
?>
