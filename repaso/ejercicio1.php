<?php
session_start();

if (!isset($_SESSION['productos'])) {
    $_SESSION['productos'] = [];
}

if (!isset($_SESSION['ficheros'])) {
    $_SESSION['ficheros'] = [];
}
if (isset($_POST['añadir'])) {
    $nuevo_producto = $_POST['productos'];
    $nombre_fichero = $_POST['fichero_nombre'];
    if ($nuevo_producto != "") {
        $numero_letras = strlen($nuevo_producto);
        $codigo_pro = strtoupper(substr($nuevo_producto, 0, 3));
        $_SESSION['productos'][] = ['nombre' => $nuevo_producto, 'numero' => $numero_letras, 'codigo' => $codigo_pro];
    }
    if ($nombre_fichero != "") {
        $_SESSION['ficheros'][] = ['nombre_fichero' => $nombre_fichero];
    }
}

if (isset($_POST['empezar_nuevo'])) {
    $_SESSION['productos'] = [];
    $_SESSION['ficheros'] = [];

    setcookie('datos', '', time() - 3600);
}

setcookie('datos', base64_encode(serialize($_SESSION['productos'])), time() + 3600);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>


    <form method="post">
        <input type="text" name="productos" placeholder="nombre del producto">
        <input type="text" name="fichero_nombre" placeholder="Nombre del fichero">
        <select name="fichero_elegido">
            <?php

            foreach ($_SESSION['ficheros'] as $u) {
            ?>
                <option value="<?= $u['nombre_fichero'] ?>" name="tipo"><?= $u['nombre_fichero'] ?></option>
            <?php
            }
            ?>
            <input type="submit" name="añadir" value="Añadir" required>
            <input type="submit" name="terminar" value="terminar">
            <input type="submit" name="confirmar" value="confirmar">
            <input type="submit" name="empezar_nuevo" value="EMPEZAR NUEVO">
    </form>
    <?php
    if (isset($_POST['confirmar'])) {
        $fichero_seleccionado = $_POST['fichero_elegido'];
        if ($fichero_seleccionado != "" && isset($_COOKIE['datos'])) {
            $fp = fopen($fichero_seleccionado, 'a');
            if ($fp) {
                $productos_guardados = base64_decode($_COOKIE['datos']);
                $original_productos = unserialize($productos_guardados);

                echo "Número de productos: " . count($original_productos) . "<br>";

                foreach ($original_productos as $producto) {
                    $linea =  $producto['nombre'] . " - [" . $producto['codigo'] . "," . $producto['numero'] . "] <br>";

                    fwrite($fp, $linea);
                }
                fclose($fp);
                echo "Productos guardados en el fichero: " . $fichero_seleccionado;
            }
        } else {
            echo "El fichero no existe.";
        }
    }
    ?>

</body>

</html>