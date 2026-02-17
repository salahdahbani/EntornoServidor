<?php
require_once '../Model/Ticket.php';
require_once '../Model/Usuario.php';
if (session_status() == PHP_SESSION_NONE) session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Nuevo ticket</h1>
<hr>
<form action="../Controller/aniadir.php" method="post">
    Descripcion: <input type="text" name="descripcion"><br><br>
    <input type="hidden" name="estado" value="pendiente">
    <!-- Usar usuario_id que sí se guarda en sesión desde login -->
    <input type="hidden" name="id_usuario" value="<?= $_SESSION['usuario_id'] ?>">
    <input type="submit" value="Crear ticket">
</form>
<br>
<a href="../Controller/index.php">Volver al listado de tickets</a>
</body>
</html>