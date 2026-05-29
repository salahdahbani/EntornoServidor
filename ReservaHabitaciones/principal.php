<?php
session_start();

// Si el usuario no está autenticado, redirige al login
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

// Cargar las habitaciones
$habitaciones = cargarHabitaciones();

// Procesar el formulario para reservar una habitación
if (isset($_POST['reservar'])) {
    $numero = $_POST['numero'];
    reservarHabitacion($numero, $_SESSION['usuario']);
    $habitaciones = cargarHabitaciones(); // Recargar las habitaciones
}

// Cargar las reservas del usuario
$reservas = cargarReservas($_SESSION['usuario']);

// Función para cargar las habitaciones
function cargarHabitaciones() {
    if (file_exists('habitaciones.dat')) {
        $habitaciones = [];
        $lineas = file('habitaciones.dat', FILE_IGNORE_NEW_LINES);
        foreach ($lineas as $linea) {
            list($numero, $tipo, $precio, $disponible) = explode(',', $linea);
            $habitaciones[] = [
                'numero' => $numero,
                'tipo' => $tipo,
                'precio' => $precio,
                'disponible' => $disponible === 'true'
            ];
        }
        return $habitaciones;
    }
    return [];
}

// Función para reservar una habitación
function reservarHabitacion($numero, $usuario) {
    $habitaciones = cargarHabitaciones();
    foreach ($habitaciones as &$habitacion) {
        if ($habitacion['numero'] === $numero && $habitacion['disponible']) {
            $habitacion['disponible'] = false;
            break;
        }
    }

    // Guardar las habitaciones actualizadas
    guardarHabitaciones($habitaciones);

    // Guardar la reserva
    file_put_contents('reservas.dat', "$usuario,$numero," . date('d/m/Y') . "\n", FILE_APPEND);
}

// Función para guardar las habitaciones
function guardarHabitaciones($habitaciones) {
    $lineas = [];
    foreach ($habitaciones as $habitacion) {
        $lineas[] = implode(',', [
            $habitacion['numero'],
            $habitacion['tipo'],
            $habitacion['precio'],
            $habitacion['disponible'] ? 'true' : 'false'
        ]);
    }
    file_put_contents('habitaciones.dat', implode("\n", $lineas));
}

// Función para cargar las reservas de un usuario
function cargarReservas($usuario) {
    if (file_exists('reservas.dat')) {
        $reservas = [];
        $lineas = file('reservas.dat', FILE_IGNORE_NEW_LINES);
        foreach ($lineas as $linea) {
            list($user, $numero, $fecha) = explode(',', $linea);
            if ($user === $usuario) {
                $reservas[] = [
                    'numero' => $numero,
                    'fecha' => $fecha
                ];
            }
        }
        return $reservas;
    }
    return [];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reservas de Hotel</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .no-disponible {
            background-color: #ffcccc;
        }
    </style>
</head>
<body>
    <h1>Bienvenido, <?= $_SESSION['usuario'] ?></h1>
    <h2>Habitaciones Disponibles</h2>
    <table>
        <thead>
            <tr>
                <th>Número</th>
                <th>Tipo</th>
                <th>Precio</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($habitaciones as $habitacion): ?>
                <tr class="<?= $habitacion['disponible'] ? '' : 'no-disponible' ?>">
                    <td><?= $habitacion['numero'] ?></td>
                    <td><?= $habitacion['tipo'] ?></td>
                    <td><?= $habitacion['precio'] ?></td>
                    <td><?= $habitacion['disponible'] ? 'Disponible' : 'No Disponible' ?></td>
                    <td>
                        <?php if ($habitacion['disponible']): ?>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="numero" value="<?= $habitacion['numero'] ?>">
                                <button type="submit" name="reservar">Reservar</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Mis Reservas</h2>
    <table>
        <thead>
            <tr>
                <th>Número de Habitación</th>
                <th>Fecha de Reserva</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservas as $reserva): ?>
                <tr>
                    <td><?= $reserva['numero'] ?></td>
                    <td><?= $reserva['fecha'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="logout.php">Cerrar sesión</a>
</body>
</html>