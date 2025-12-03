<?php
if (session_status() == PHP_SESSION_NONE) session_start();

if (isset($_POST['seleccionado'])) {
    $seleccionado = $_POST['seleccionado'];

    foreach ($_SESSION['productos'] as $producto => $datos) {
        if ($datos["nombre"] == $seleccionado) {
            if (isset($_SESSION['carro'][$seleccionado])) {
                $_SESSION['carro'][$seleccionado]++;
            } else {
                $_SESSION['carro'] += [$seleccionado => 1];
            }
        }
    }
    $carritoSer = base64_encode(serialize($_SESSION['carro']));
    setcookie("carro", $carritoSer, time() + 60 * 60 * 24);
    header("Location: index.php");
    exit();
} else {
    $seleccionado = $_POST['seleccionado1'];

    foreach ($_SESSION['productos'] as $producto => $datos) {
        if ($datos["nombre"] == $seleccionado) {
            if (isset($_SESSION['carro'][$seleccionado])) {
                $_SESSION['carro'][$seleccionado]++;
            } else {
                $_SESSION['carro'] += [$seleccionado => 1];
            }
        }
    }
    $carritoSer = base64_encode(serialize($_SESSION['carro']));
    setcookie("carro", $carritoSer, time() + 60 * 60 * 24);
    header("Location: detalle.php");
    exit();
}
