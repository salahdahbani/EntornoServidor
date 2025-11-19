<?php
if (session_status() == PHP_SESSION_NONE) session_start();

if (isset($_POST['fecha'])) {
    $_SESSION['mascotas'] = [];

    $fechaRecogida = $_POST['fecha'];
    $fechaEncontrada = false;
    $archivo = fopen("mascotas.txt", "r");
    while (!feof($archivo)) {
        $linea = trim(fgets($archivo));


        if (str_starts_with($linea, "#")) {
            $fechaLinea = substr($linea, 1, 10);
            $fechaEncontrada = ($fechaLinea == $fechaRecogida);
        }

        if ($fechaEncontrada && str_starts_with($linea, "#") == false) {

            if (!empty($linea)) {
                $arrayDatos = explode("-", $linea);
                $_SESSION['mascotas'][] = [
                    "nombre" => $arrayDatos[0],
                    "animal" => $arrayDatos[1],
                    "edad"   => $arrayDatos[2],
                ];
            }
        }
    }
    fclose($archivo);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio2</title>
    <style>
        * {
            font-family: sans-serif;
        }

        table,
        tr,
        td,
        th {
            border: 1px solid;
        }
    </style>
</head>

<body>

    <?php
    if (isset($_POST['fecha'])) {
    ?>
        <table>
            <tr>
                <th colspan="4">Fecha:<?= $fechaRecogida  ?></th>
            </tr>
            <tr>
                <td>Nombre</td>
                <td>Animal</td>
                <td>Edad</td>
            </tr>
            <?php
            foreach ($_SESSION['mascotas'] as $mascota => $datos) {
            ?>
                <tr>
                    <td><?= $datos["nombre"] ?></td>
                    <td><?= $datos["animal"] ?></td>
                    <td><?= $datos["edad"] ?></td>

                </tr>
            <?php
            }
            ?>
        </table>
    <?php
    }
    ?>

    <form action="" method="post">
        <label>Selecciona una fecha:</label>
        <select name="fecha" value="Selecciona" required>
            <option>fechas</option>
            <?php
            if (file_exists("mascotas.txt")) {
                $archivo = fopen("mascotas.txt", "r");
                do {
                    $linea = trim(fgets($archivo));
                    if (str_starts_with($linea, "#")) {
                        $fecha = substr($linea, 1, 10);
                        echo "<option value='$fecha'>$fecha</option>";
                    }
                } while (!feof($archivo));
                fclose($archivo);
            }
            ?>
        </select>
        <input type="submit" value="Enviar">
    </form>
</body>

</html>