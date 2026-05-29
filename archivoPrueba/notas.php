<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] === 'admin') {
    header("Location: login.php");
    exit;
}
$notas = file_exists("notas.dat") ? unserialize(file_get_contents("notas.dat")) : [];
?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Notas Públicas</title></head>
<body>
<h2>Notas del Admin</h2>
<table border="1">
    <tr><th>Fecha</th><th>Contenido</th></tr>
    <?php foreach ($notas as $n): ?>
        <tr>
            <td><?= $n['fecha'] ?></td>
            <td style="<?= $n['completada'] ? 'color:red;text-decoration:line-through;' : '' ?>">
                <?= htmlspecialchars($n['contenido']) ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<br>
<a href="logout.php">Cerrar sesión</a>
</body>
</html>
