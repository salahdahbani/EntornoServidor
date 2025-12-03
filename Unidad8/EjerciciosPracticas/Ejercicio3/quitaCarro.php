<?php
if (session_status() == PHP_SESSION_NONE) session_start();

if (isset($_POST['seleccionado'])) {
    $seleccionado = $_POST['seleccionado'];

    foreach ($_SESSION['productos'] as $producto => $datos) {
        if ($datos["nombre"] == $seleccionado) {
            if ($_SESSION['carro'][$seleccionado] > 1) {
                $_SESSION['carro'][$seleccionado]--;
            } else {
                unset($_SESSION['carro'][$seleccionado]);
            }
        }
    }
    $carritoSer = base64_encode(serialize($_SESSION['carro']));
    setcookie("carro", $carritoSer, time() + 60 * 60 * 24);
    header("Location: Cesta.php");
    exit();
} else {
    header("Location: index.php");
    exit();
}
