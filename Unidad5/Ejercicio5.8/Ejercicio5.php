<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Aspirantes</title>
</head>
<body>

<h2>Aplicación de aspirantes</h2>
<?php


if (isset($_REQUEST['aspirantes']) && $_REQUEST['aspirantes'] !== '') {
    $aspirantes = @unserialize(base64_decode($_REQUEST['aspirantes']));
    if ($aspirantes === false) $aspirantes = array();
} else {
    $aspirantes = array();
}

// añadir aspirante
if (isset($_REQUEST['add'])) {
    $nombre = isset($_REQUEST['nombre']) ? $_REQUEST['nombre'] : '';
    $edad = isset($_REQUEST['edad']) ? intval($_REQUEST['edad']) : 0;
    $exp = isset($_REQUEST['exp']) ? intval($_REQUEST['exp']) : 0;
    $correo = isset($_REQUEST['correo']) ? $_REQUEST['correo'] : '';
    if ($nombre !== '') {
        $aspirantes[$nombre] = array('edad'=>$edad, 'exp'=>$exp, 'correo'=>$correo);
    }
}

// finalizar listado
$finalizar = isset($_REQUEST['finalizar']);

$asp_ser = base64_encode(serialize($aspirantes));
?>

<?php if (!$finalizar): ?>
<form method="post">
    Nombre: <input name="nombre"><br>
    Edad: <input name="edad" type="number"><br>
    Años experiencia: <input name="exp" type="number"><br>
    Correo: <input name="correo" type="email"><br>
    <input type="hidden" name="aspirantes" value="<?php echo $asp_ser; ?>">
    <button name="add">Aceptar</button>
    <button name="finalizar">Finalizar</button>
</form>
<?php endif; ?>

<h3>Lista de aspirantes</h3>

<?php if (count($aspirantes) === 0): ?>
<p>No hay aspirantes.</p>
<?php else: ?>
<table border="1">
    <tr><th>Nombre</th><th>Edad</th><th>Años exp</th><th>Correo</th></tr>
    <?php foreach ($aspirantes as $n => $a): ?>
    <tr>
        <?php if ($a['edad'] > 30): ?>
        <td style="color:red"><?php echo $n; ?></td>
        <td style="color:red"><?php echo $a['edad']; ?></td>
        <td style="color:red"><?php echo $a['exp']; ?></td>
        <td style="color:red"><?php echo $a['correo']; ?></td>
        <?php else: ?>
        <td><?php echo $n; ?></td>
        <td><?php echo $a['edad']; ?></td>
        <td><?php echo $a['exp']; ?></td>
        <td><?php echo $a['correo']; ?></td>
        <?php endif; ?>
    </tr>
    <?php endforeach; ?>
</table>
<?php endif; ?>

<?php if ($finalizar): ?>
<p>El listado ha finalizado.</p>
<?php endif; ?>

</body>
</html>
