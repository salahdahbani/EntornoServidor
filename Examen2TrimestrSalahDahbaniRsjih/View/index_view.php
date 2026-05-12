<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Logística UTRETRANS</title>
</head>
<body>

<h2>Logística de Transportes UTRETRANS</h2>
<hr>

<form action="../Controller/aniadir.php" method="post">
<table border="1">
    <tr>
        <th>ORIGEN</th>
        <th>DESTINO</th>
        <th>EMPRESA</th>
        <th>FECHA</th>
        <th></th>
    </tr>
    <tr>
        <td>
            <select name="origen" required>
                <option value="">-- Elige origen --</option>
                <?php foreach ($ciudades as $ciudad) { ?>
                    <option value="<?= $ciudad->getId(); ?>">
                        <?= $ciudad->getNombre(); ?>
                    </option>
                <?php } ?>
            </select>
        </td>

        <td>
            <select name="destino" required>
                <option value="">-- Elige destino --</option>
                <?php foreach ($ciudades as $ciudad) { ?>
                    <option value="<?= $ciudad->getId(); ?>">
                        <?= $ciudad->getNombre(); ?>
                    </option>
                <?php } ?>
            </select>
        </td>

        <td><input type="text" name="empresa" required></td>
        <td><input type="date" name="fecha" required></td>
        <td><input type="submit" value="NUEVO TRANSPORTE"></td>
    </tr>
</table>
</form>

<br>

<?php if (isset($_GET['mensaje'])) { ?>
    <p style="color:green;"><strong><?= $_GET['mensaje']; ?></strong></p>
<?php } ?>

<hr>

<table border="1">
    <tr>
        <th>Origen</th>
        <th>Destino</th>
        <th>Empresa</th>
        <th>Fecha</th>
        <th>Actualizar</th>
    </tr>
<?php 
     foreach ($transportes as $t) { 

$fechaActual = date('Y-m-d');
if ($fechaActual > $t->getFecha()) {
    $style = "background-color: #e00505;";
} else {
    $style = "";
}
?>
        <tr style="<?= $style; ?>">
                <td><?= $t->getOrigen(); ?></td>
            <td><?= $t->getDestino(); ?></td>
            <td><?= $t->getEmpresa(); ?></td>

            <td>
                <form action="../Controller/actualizar_fecha.php" method="post">
                    <input type="hidden" name="id" value="<?= $t->getId(); ?>">
                    <input type="date" name="fecha" value="<?= $t->getFecha(); ?>" required>
            </td>
            <td>
                    <input type="submit" value="Cambiar Fecha">
                </form>
            </td>
        </tr>
    <?php } ?>

</table>

</body>
</html>
