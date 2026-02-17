<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<h2>Iniciar sesión</h2>
<hr>

<?php if ($error != "") { ?>
    <p style="color:red;"><?php echo $error; ?></p>
<?php } ?>

<form action="login.php" method="post">
    Usuario: <input type="text" name="nombre"><br><br>
    Contraseña: <input type="password" name="password"><br><br>
        <input type="hidden" name="rol" value="client"><br><br>
     <input type="submit" value="ACCESO USUARIO" name="login">
        <input type="submit" value="REGISTRO USUARIO" name="registro">

</form>
</body>
</html>