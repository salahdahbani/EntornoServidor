<?php
if (session_status() == PHP_SESSION_NONE) session_start();
// Cuenta la cantidad de productos que hay en la cesta
$suma = 0;
foreach ($_SESSION['carro'] as $producto => $cantidad) {
    $suma += $cantidad;
}
// Cuenta los euros totales que cuestan los productos de la cesta
$total = 0;
foreach ($_SESSION['productos'] as $producto => $datos) {
    foreach ($_SESSION['carro'] as $nombre => $cantidad) {
        if ($nombre == $datos["nombre"]) {
            $total += $cantidad*$datos['precio'];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cesta</title>
    <link rel="stylesheet" href="css/Cesta.css">
</head>

<body>
    <table>

        <tr class="headerTabla">
            <td class="titulos" colspan="4">Productos de la cesta</td>
        </tr>
        <?php
        foreach ($_SESSION['productos'] as $producto => $datos) {
            foreach ($_SESSION['carro'] as $nombre => $cantidad) {
                if ($nombre == $datos["nombre"]) {
                    echo "<tr>";
                    echo "<td>" .  $nombre . "</td>";
                    echo "<td>" .  $cantidad . "</td>";
                    echo "<td><a href='detalle.php?producto=" . $datos["nombre"] . "'><img src='" .  $datos["img"] . "'></a> <p>" . $datos['precio'] . " euros</p></td>";
        ?>
                    <td class="botonComprar">
                        <form action="QuitaCarro.php" method="post">
                            <input type="hidden" name="seleccionado" value="<?= $datos["nombre"] ?>">
                            <input type="submit" value="Eliminar">
                        </form>
                    </td>
                    </tr>
        <?php
                }
            }
        }
        ?>
        <tr>
            <td>Total</td>
            <td><?= $suma ?></td>
            <td><?= $total ?></td>
            <td>
                <a href="vaciarCesta.php" class="volver">Vaciar cesta</a>
            </td>
        </tr>
        <tr>
            <td colspan="4"><a href="index.php" class="volver">Volver al la tienda</a></td>
        </tr>
    </table>
</body>

</html>