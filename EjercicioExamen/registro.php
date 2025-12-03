<?php
$archivo = "usuarios.txt" ;
if(session_status() == PHP_SESSION_NONE) session_start();
//Inicializamos la sesion
if(!isset($_SESSION['user'])){
    $_SESSION['user']=[]; 
}

if(isset($_POST['añadir'])){
$user = $_POST['user'];
$contra = $_POST['passw'];
$datos = "$user, $contra";
$_SESSION['user'][] = [
            'user' => $user,
            'contra' => $contra
  ];

    $existeUsuario = mirarDatos($datos);
    $archivo = fopen("usuarios.txt", "a");
    if (!$existeUsuario) {
        fwrite($archivo, $datos . PHP_EOL);
    }
    foreach ($_SESSION['user'] as $usuario => $datos) {
        fwrite($archivo, $datos['user'] . "," . $datos['contra'] . PHP_EOL);
    }
    fclose($archivo);
    session_destroy();
    header("refresh: 0");

}
function mirarDatos($datos)
{
    if(!file_exists("usuarios.txt")) return false;

    $file = fopen("usuarios.txt", "r");

    while (($linea = fgets($file)) !== false) {
        if (trim($linea) === $datos ) {
            fclose($file);
            return true;
        }
    }
    fclose($file);
    return false;
}

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form method="post">
    <label>Introduce tu usuario:</label>
    <input type="text" name="user">
    <br>
    <label>Contraseña:</label>
    <input type="password" name="passw">
    <br>
    <input type="submit" value="Añadir" name="añadir">
</form>
<br>
<br>
<a href="login.php">Volver al login</a>
    
</body>
</html>