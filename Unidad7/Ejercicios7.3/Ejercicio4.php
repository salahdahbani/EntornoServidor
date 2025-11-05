<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Documento</title>
</head>
<body>

<?php
session_start();

$usuarios = [
    "admin" => "1234",
    "usuario2" => "abcd"
];

$error = "";

if (isset($_POST['cerrar'])) {
    session_destroy();
    $_SESSION = [];
}

if (isset($_SESSION['usuario'])) {
    $mostrarEjercicio = true;
} else {
    $mostrarEjercicio = false;
}

if (isset($_POST['login'])) {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    if (isset($usuarios[$usuario]) && $usuarios[$usuario] == $password) {
        $_SESSION['usuario'] = $usuario;
        $mostrarEjercicio = true;
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
?>

<?php if (!$mostrarEjercicio) { ?>
    <h2>Iniciar sesión</h2>
    <?php if ($error) { echo "<p>$error</p>"; } ?>
    <form method="post">
        <label>Usuario:</label>
        <input type="text" name="usuario" required><br><br>
        <label>Contraseña:</label>
        <input type="password" name="password" required><br><br>
        <button type="submit" name="login">Entrar</button>
    </form>

<?php } else { ?>
    <h2>Ejercicio 1: Media de números positivos</h2>
    <p>Usuario: <?php echo $_SESSION['usuario']; ?></p>

    <form method="post">
        <button type="submit" name="cerrar">Cerrar sesión</button>
    </form>

    <?php
   if(!isset($_SESSION['numeros'])){
    $_SESSION['numeros']=[]; 
}

if(isset($_POST['numero'])){
    $numero = $_POST['numero'];

    if($numero>= 0){
        $_SESSION['numeros'][]=$numero;
    }else {

        if(count($_SESSION['numeros']) > 0){
            $suma = 0;
            foreach($_SESSION['numeros'] as $n){
                $suma += $n;
            }
            $media = $suma/count($_SESSION['numeros']);
            echo "<h3>La media es: " . $media . " </h3>";
        }else {
            echo "<h3>No se han introducido números por ahora</h3>";
        }

         echo '<br><a href="Ejercicio1.php">Volver a empezar</a>';
    }
}
    ?>

    <form method="post">
        <label>Introduce un número:</label>
        <input type="number" name="numero" step="any" required>
        <button type="submit">Añadir</button>
    </form>

<?php } ?>

</body>
</html>
