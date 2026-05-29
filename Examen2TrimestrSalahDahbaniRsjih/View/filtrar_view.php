<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

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
            <?php foreach ($ciudades as $c) {
                if ($c->getId() == $t->getOrigen()) { ?>
                    <td><?= $c->getNombre(); ?></td>
                <?php } ?>
            <?php } ?>
            <?php foreach ($ciudades as $c) {
                if ($c->getId() == $t->getDestino()) { ?>
                    <td><?= $c->getNombre(); ?></td>
                <?php } ?>
            <?php } ?>
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
<br>
<a href="../Controller/index.php">Volver a pagina principal</a>
    
</body>
</html>