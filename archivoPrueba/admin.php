<?php
session_start();
if ($_SESSION['usuario'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$archivoNotas = "notas.dat";
$notas = file_exists($archivoNotas) ? unserialize(file_get_contents($archivoNotas)) : [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'];
    $id = $_POST['id'] ?? null;

    if ($accion === 'crear') {
        $nota = [
            'id' => uniqid(),
            'contenido' => $_POST['contenido'],
            'fecha' => date("Y-m-d H:i"),
            'completada' => false
        ];
        $notas[] = $nota;
    } elseif ($accion === 'borrar') {
        $notas = array_filter($notas, fn($n) => $n['id'] !== $id);
    } elseif ($accion === 'completar') {
        foreach ($notas as &$n) {
            if ($n['id'] === $id) {
                $n['completada'] = !$n['completada'];
                break;
            }
        }
    } elseif ($accion === 'editar') {
        foreach ($notas as &$n) {
            if ($n['id'] === $id) {
                $n['contenido'] = $_POST['nuevo_contenido'];
                break;
            }
        }
    } elseif ($accion === 'eliminar_todo') {
        if (file_exists($archivoNotas)) {
            unlink($archivoNotas);
        }
        setcookie("usuario", "", time() - 3600); // borrar cookie
        header("Location: admin.php");
        exit;
    }

    file_put_contents($archivoNotas, serialize($notas));
    header("Location: admin.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Panel del Administrador</title>
</head>
<body>
    <h2>Notas del Administrador</h2>

    <form method="POST">
        <textarea name="contenido" required></textarea><br>
        <input type="hidden" name="accion" value="crear">
        <input type="submit" value="Agregar Nota">
    </form>

    <br>
    <table border="1" cellpadding="5">
        <tr><th>Fecha</th><th>Nota</th><th>Acciones</th></tr>
        <?php foreach ($notas as $n): ?>
        <tr>
            <td><?= $n['fecha'] ?></td>
            <td style="<?= $n['completada'] ? 'color:red;text-decoration:line-through;' : '' ?>">
                <?= htmlspecialchars($n['contenido']) ?>
            </td>
            <td>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="accion" value="completar">
                    <input type="hidden" name="id" value="<?= $n['id'] ?>">
                    <input type="submit" value="✔">
                </form>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="accion" value="borrar">
                    <input type="hidden" name="id" value="<?= $n['id'] ?>">
                    <input type="submit" value="🗑">
                </form>
                <form method="POST" style="display:inline;">
                    <input type="text" name="nuevo_contenido" value="<?= htmlspecialchars($n['contenido']) ?>" required>
                    <input type="hidden" name="accion" value="editar">
                    <input type="hidden" name="id" value="<?= $n['id'] ?>">
                    <input type="submit" value="✎">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <form method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar todas las notas y cookies?');">
        <input type="hidden" name="accion" value="eliminar_todo">
        <input type="submit" value="🧹 Eliminar todas las notas y cookies">
    </form>

    <br><a href="logout.php">Cerrar sesión</a>
</body>
</html>
