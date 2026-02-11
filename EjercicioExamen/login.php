<?php
$archivo = "usuarios.txt" ;
if(session_status() == PHP_SESSION_NONE) session_start();
//Inicializamos la sesion
if(!isset($_SESSION['user'])){
    $_SESSION['user']=[]; 
}

if(isset($_POST['entrar'])){
$user = $_POST['user'];
$contra = $_POST['passw'];
$datos = "$user, $contra";
$_SESSION['user']=[
    'user'=> $user,
    'contra' => $contra,
];


    $existeUsuario = mirarDatos($datos);
    $archivo = fopen("usuarios.txt", "a");
    if (!$existeUsuario) {
        echo "<p style='red';>Este usuario no esta registrado </p>";
    }else{
      
    
    fclose($archivo);
    header("Location: principal.php");
    exit();
    }


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

 if (isset($_POST['recordar'])) {
setcookie("pass_recordada", $_SESSION['user']['contra'], time() + 3*24*3600);
        header("Location: login.php");
        exit();
    }else{
        setcookie("pass_recordada", "", time() - 3600);
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

<form method="post" >
    <label>Introduce tu usuario:</label>
    <input type="text" name="user">
    <br>
    <label>Contraseña:</label>
    <input type="password" name="passw" value="<?= isset($_COOKIE['pass_recordada']) ? $_COOKIE['pass_recordada'] : '' ?>">

    <br>
    <input type="hidden" value="<?php echo $_SESSION['user']?>">
    <input type="submit" value="Entrar" name="entrar">
    <br><br>
    <label>Recordar</label>
    <input type="checkbox" name="recordar">
</form>
<form method="post" action="registro.php">
    <input type="submit" value="Registrarse" name="registro">
</form>
    
</body>
</html>