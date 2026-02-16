<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../View/style.css" type="text/css">
    <title>Login</title>
</head>
<body style="text-align: center;">
<br>
<div>
    <h1>Inicie sesión o Registre un usuario nuevo</h1>
    <form action="../Controller/login.php" method="post">
        Usuario: <input type="text" name="usuario"><br><br>
        <input type="submit" value="ACCESO USUARIO" name="login">
        <input type="submit" value="REGISTRO USUARIO" name="registro">
    </form>
    <h3 style="color: red;"><?= $data['mensaje'] ?></h3>
</div>
</body>
</html>