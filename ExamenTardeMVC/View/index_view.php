<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reserva de Salas</title>
</head>
<body>

<h2>Bienvenido, <?php echo $nombre_user; ?></h2>
<hr>

<?php if (isset($_GET['mensaje'])): ?>
    <p style="color:green;"><strong><?php echo $_GET['mensaje']; ?></strong></p>
<?php endif; ?>

<h3>
    <?php echo ($mi_rol == 'admin') ? 'Todas las reservas' : 'Mis reservas'; ?>
</h3>

<table border="1">
    <tr>
        <th>Sala</th>
        <th>Usuario</th>
        <th>Fecha</th>
        <th>Turno</th>
        <th>Acción</th>
    </tr>

<?php if (empty($datos_finales)): ?>
    <tr>
        <td colspan="5">No hay reservas registradas.</td>
    </tr>
<?php else: ?>
    <?php foreach ($datos_finales as $reserva): ?>
    <tr>
        <td><?php echo $reserva['sala']; ?></td>
        <td><?php echo $reserva['usuario']; ?></td>
        <td><?php echo $reserva['fecha']; ?></td>
        <td><?php echo ($reserva['turno'] == 'manana') ? 'Mañana' : 'Tarde'; ?></td>
        <td>
            <a href="cancelar_controller.php?id_reserva=<?php echo $reserva['id']; ?>" 
               onclick="return confirm('¿Seguro?')">Cancelar</a>
        </td>
    </tr>
    <?php endforeach; ?>
<?php endif; ?>
</table>

<br>
<a href="reserva_form.php">Nueva reserva</a>
|
<a href="logout_controller.php?cerrar=1">Cerrar sesión</a>

</body>
</html>