<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Reserva</title>
</head>
<body>

<h2>Nueva reserva</h2>
<hr>

<?php if (isset($_GET['error'])): ?>
    <p style="color:red;"><strong><?php echo $_GET['error']; ?></strong></p>
<?php endif; ?>

<form action="../Controller/reserva.php" method="post">

    Sala:
    <select name="id_sala">
        <option value="">-- Elige sala --</option>
        <?php foreach ($lista_salas as $sala): ?>
            <option value="<?php echo $sala->getId(); ?>">
                <?php echo $sala->getNombre(); ?> (<?php echo $sala->getCapacidad(); ?> personas)
            </option>
        <?php endforeach; ?>
    </select>
    <br><br>

    Fecha: <input type="date" name="fecha">
    <br><br>

    Turno:
    <select name="turno">
        <option value="manana">Mañana</option>
        <option value="tarde">Tarde</option>
    </select>
    <br><br>

    <input type="submit" value="Confirmar Reserva">
</form>

<br>
<a href="../Controller/index.php">Volver atrás</a>

</body>
</html>