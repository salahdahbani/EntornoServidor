<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
  if (isset($_REQUEST['usuario'])) {
    $fp= fopen("usuarios.dat","a");
    fwrite($fp, $_REQUEST['usuario'].','.$_REQUEST['pass'].PHP_EOL);
    fclose($fp);
    header("location: index.php"); 
  }
?>
<h1>REGISTRO DE UNA NUEVA CUENTA DE USUARIO</h1>
<h3>Introduzca los datos para registrar la cuenta</h3>
<form action="" method="post">
        USUARIO: <input type="text" name="usuario" require><br><br>
        CONTRASEÑA: <input type="password" name="pass" require><br><br>
        <input type="submit" value="ACEPTAR">
    </form>
</body>
</html>