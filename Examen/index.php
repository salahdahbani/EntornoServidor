<?php
if(session_status() === PHP_SESSION_NONE) {session_start();}
include_once 'Reserva.php';

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

if (isset($_REQUEST['logout'])) {
    setcookie('usuario', '', time() - 3600);
    setcookie('password', '', time() - 3600);
    session_destroy();
    header('Location: login.php');
    exit;
}

$usuario = $_SESSION['usuario'];
$rutaFichero = $usuario . '.rsv';

$reservas = [];
$mensaje = '';
$error = '';
$filtro = $_REQUEST['filtro'] ?? 'todas';

if (file_exists($rutaFichero)) {
    $archivo = fopen($rutaFichero, 'r');
    $password = trim(fgets($archivo));
    while (($linea = fgets($archivo)) !== false) {
        $reserva = unserialize($linea);
        $reservas[] = $reserva;
    }
    fclose($archivo);

    $pendientes = 0;
    foreach ($reservas as $reserva) {
        if ($reserva->estado === 'PENDIENTE') {
            $pendientes++;
        }
    }
    Reserva::setTotalPendientes($pendientes);
}


if (isset($_POST['nuevaReserva'])) {
    $fechaHora = strtotime($_POST['fechaHora']);
    $sala = $_POST['sala'];
    if ($fechaHora && $sala) {
        $reserva = new Reserva($usuario, $fechaHora, $sala);
        $reservas[] = $reserva;
        $mensaje = 'Reserva añadida con éxito.';
    } else {
        $error = 'Datos inválidos para la nueva reserva.';
    }
} elseif (isset($_POST['accion'])) {
    $indice = $_POST['indice'];
    $accion = $_POST['accion'];
    if (isset($reservas[$indice])) {
        $reserva = $reservas[$indice];
        if ($accion === 'confirmar') {
            $resultado = $reserva->confirmar();
            $mensaje = $resultado === 'ok' ? 'Reserva confirmada.' : 'No se puede confirmar.';
        } elseif ($accion === 'anular') {
            $resultado = $reserva->anular();
            $mensaje = $resultado === 'ok' ? 'Reserva anulada.' : 'No se puede anular.';
        }
    }
}

    $archivo = fopen($rutaFichero, 'w');
    fwrite($archivo, $password . "\n");
    foreach ($reservas as $reserva) {
        fwrite($archivo, serialize($reserva) . "\n");
    }
    fclose($archivo);


$reservasFiltradas = [];
foreach ($reservas as $reserva) {
    if ($filtro === 'todas' || $reserva->estado === strtoupper($filtro)) {
        $reservasFiltradas[] = $reserva;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestión de Reservas</title>
</head>
<body>
    <h1>Bienvenido, <?= $usuario ?></h1>
    <p>Total de reservas pendientes: <?= Reserva::getTotalPendientes() ?></p>

    <?php if ($mensaje): ?>
        <p style="color: green;"><?= $mensaje ?></p>
    <?php endif; ?>
    <?php if ($error): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>

    <h2>Filtrar Reservas</h2>
    <form method="POST" action="index.php">
        <select name="filtro">
            <option value="todas" <?= $filtro === 'todas' ? 'selected' : '' ?>>Todas</option>
            <option value="pendiente" <?= $filtro === 'pendiente' ? 'selected' : '' ?>>Pendientes</option>
            <option value="confirmada" <?= $filtro === 'confirmada' ? 'selected' : '' ?>>Confirmadas</option>
            <option value="anulada" <?= $filtro === 'anulada' ? 'selected' : '' ?>>Anuladas</option>
        </select>
        <button type="submit">Aplicar Filtro</button>
    </form>

    <h2>Tus Reservas</h2>
    <table border="1">
        <tr>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Sala</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($reservasFiltradas as $indice => $reserva): ?>
            <tr>
                <td><?= $reserva->getFecha() ?></td>
                <td><?= $reserva->getHora() ?></td>
                <td><?= $reserva->sala ?></td>
                <td><?= $reserva->estado ?></td>
                <td>
                    <?php if ($reserva->estado === 'PENDIENTE'): ?>
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="indice" value="<?= $indice ?>">
                            <button type="submit" name="accion" value="confirmar">Confirmar</button>
                        </form>
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="indice" value="<?= $indice ?>">
                            <button type="submit" name="accion" value="anular">Anular</button>
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Nueva Reserva</h2>
    <form method="POST">
        Sala: <input type="text" name="sala" required><br>
        Fecha y Hora: <input type="datetime-local" name="fechaHora" required><br>
        <button type="submit" name="nuevaReserva">Añadir Reserva</button>
    </form>

    <br><a href="index.php?logout=true">Cerrar Sesión</a>
</body>
</html>