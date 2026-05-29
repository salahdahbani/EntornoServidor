<?php
session_start();
if ($_SESSION['usuario'] !== 'admin') {
    die("Acceso denegado.");
}

$id = $_POST['id'];
$notas = file("notas.dat", FILE_IGNORE_NEW_LINES);
$nota = '';

foreach ($notas as $linea) {
    list($nid, $texto, $fecha, $completada) = explode('|', $linea);
    if ($nid == $id) {
        $nota = $linea;
        break;
    }
}

if (!$nota) {
    echo "Nota no encontrada.";
    exit;
}

list($nid, $texto, $fecha, $completada) = explode('|', $nota);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar nota</title>
</head>
<body>
    <h2>Editar Nota #<?= $id ?></h2>
    <form method="POST" action="procesar_nota.php">
        <input type="hidden" name="id" value="<?= $id ?>">
        <textarea name="nuevo_contenido" required><?= htmlspecialchars($texto) ?></textarea><br>
        <input type="submit" name="accion" value="Guardar">
    </form>
    <p><a href="notas.php">Volver</a></p>
</body>
</html>               