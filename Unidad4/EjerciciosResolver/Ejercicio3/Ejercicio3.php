<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Juego de Adivinar Imagen</title>
</head>
<body>
<h1>Juego de Adivinar Imagen</h1>

<?php
session_start();

// Nombre correcto de la imagen
$nombre_correcto = "gato";

// Inicializar piezas
if (!isset($_SESSION['piezas'])) {
    $_SESSION['piezas'] = array_fill(1, 9, false);
}

// Inicializar contador de intentos
if (!isset($_SESSION['intentos'])) {
    $_SESSION['intentos'] = 0;
}

$mensaje = "";
$acertado = isset($_SESSION['acertado']) ? $_SESSION['acertado'] : false;

// Comprobar si el usuario hizo clic en una pieza
if (isset($_REQUEST['pieza'])) {
    $pieza = intval($_REQUEST['pieza']);
    $_SESSION['piezas'][$pieza] = true;
    $_SESSION['intentos']++; // Incrementar intentos al pulsar una pieza
}

// Comprobar si el usuario envió respuesta
if (isset($_POST['respuesta'])) {
    $_SESSION['intentos']++; // Incrementar intentos al intentar adivinar
    $respuesta = strtolower(trim($_POST['respuesta']));
    if ($respuesta === $nombre_correcto) {
        $acertado = true;
        $_SESSION['acertado'] = true;
        $mensaje = "¡Felicidades! Has acertado en " . $_SESSION['intentos'] . " intentos.";
    } else {
        $mensaje = "No has acertado. Llevas " . $_SESSION['intentos'] . " intentos.";
    }
}

// Reiniciar juego
if (isset($_GET['reiniciar'])) {
    unset($_SESSION['piezas']);
    unset($_SESSION['acertado']);
    unset($_SESSION['intentos']);
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}
?>

<p>Intentos: <?= $_SESSION['intentos'] ?></p>

<?php if ($acertado): ?>
    <p><?= $mensaje ?></p>
    <img src="ImagenGato/gato.jpg" width="300" height="300">
    <p><a href="?reiniciar=1">Jugar de nuevo</a></p>
<?php else: ?>
    <?php if ($mensaje && !isset($_SESSION['acertado'])): ?>
        <p><?= $mensaje ?></p>
    <?php endif; ?>

    <table border="1" cellpadding="0" cellspacing="0">
    <?php
    $contador = 1;
    for ($i=0; $i<3; $i++) {
        echo "<tr>";
        for ($j=0; $j<3; $j++) {
            $fil = $i + 1;
            $col = $j + 1;
            echo "<td>";
            echo "<form method='get'>";
            echo "<input type='hidden' name='pieza' value='$contador'>";
            $imagen = $_SESSION['piezas'][$contador] ? "ImagenGato/fila-$fil-columna-$col.png" : "ImagenGato/gris.jpg";
            echo "<input type='image' src='$imagen' width='100' height='100'>";
            echo "</form>";
            echo "</td>";
            $contador++;
        }
        echo "</tr>";
    }
    ?>
    </table>

    <form method="post">
        <input type="text" name="respuesta" placeholder="¿Qué es?" required>
        <button type="submit">Comprobar</button>
    </form>
<?php endif; ?>

</body>
</html>
