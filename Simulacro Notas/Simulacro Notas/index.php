<?php
if (session_status() == PHP_SESSION_NONE) session_start();
if (isset($_REQUEST['cerrar'])) {
    unset($_SESSION['usuario']);
}
if (!isset($_SESSION['notas'])) {
    //Creación de array de sesión que contiene las notas de todos los usuarios
    $_SESSION['notas'] = [];
}
$mensaje = "";
if (isset($_SESSION['usuario'])) {
    header("location: principal.php");
} else {
    if (isset($_REQUEST['usuario']) && isset($_REQUEST['pass'])) {
        if (comprobar($_REQUEST['usuario'], $_REQUEST['pass'])) {
            if (isset($_REQUEST['recordar'])) {
                setcookie("user",$_REQUEST['usuario'], strtotime("+1 month"));
                setcookie("pass",$_REQUEST['pass'], strtotime("+1 month"));
            }else{
                setcookie("user","", -1);
                setcookie("pass","", -1);
            }
            $_SESSION['usuario']=$_REQUEST['usuario'];
            header("location: principal.php");
        } else {
            $mensaje = "Usuario o contraseña incorrectos!!!";
        }
    }
}

function comprobar($user, $pass)
{
    if (file_exists('usuarios.dat')) {
        $fp = fopen("usuarios.dat", "r");
        while ($usuario = fgetcsv($fp,0,',')) {
            if ($usuario[0]==$user && $usuario[1]==$pass) {
                fclose($fp);
                return true;
            }
        }
        fclose($fp);
    } 
    return false;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body style="text-align: center;">
    <br><br>
    <h1>MASQUENOTAS</h1>
    <h2>Tus notas siempre accesibles en cualquier lugar</h2>
    <br><br>
    <hr>
    <h3>Inicie sesión para acceder a su panel de notas</h3>
    <?php
      if (isset($_COOKIE['user'])) {
        $user=$_COOKIE['user'];
        $pass=$_COOKIE['pass'];
        $recordar="checked";
    }else {
          $user="";
          $pass="";
          $recordar="";
    }
    ?>
    <form action="" method="post">
        USUARIO: <input type="text" name="usuario" value="<?= $user ?>" require><br><br>
        CONTRASEÑA: <input type="password" name="pass" value="<?= $pass ?>" require><br><br>
        Recordar contraseña <input type="checkbox" name="recordar" <?= $recordar ?>><br><br>
        <input type="submit" value="ACEPTAR">
    </form>
    <h4 style="color: red;"><?= $mensaje ?></h4><br>
    <hr>
    <h3>¿Todavía no tienes cuenta? Regístrate, es gratis</h3>
    <form action="registrar.php" method="post">
        <input type="submit" value="REGISTRAR">
    </form>
    <br>
    <hr>
</body>

</html>