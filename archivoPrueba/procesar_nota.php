<?php
session_start();
if ($_SESSION['usuario'] !== 'admin') {
    die("Acceso denegado.");
}

$accion = $_POST['accion'];
$notas = file_exists("notas.dat") ? file("notas.dat", FILE_IGNORE_NEW_LINES) : [];

if ($accion === "Crear") {
    $contenido = trim($_POST['contenido']);
    $id = count($notas) + 1;
    $fecha = date("Y-m-d H:i:s");
    $nuevaNota = "$id|$contenido|$fecha|0";
    file_put_contents("notas.dat", $nuevaNota . "\n", FILE_APPEND);
}
elseif ($accion === "Eliminar") {
    $id = $_POST['id'];
    $nuevasNotas = array_filter($notas, fn($linea) => explode('|', $linea)[0] != $id);
    file_put_contents("notas.dat", implode("\n", $nuevasNotas) . "\n");
}
elseif ($accion === "Completar") {
    $id = $_POST['id'];
    foreach ($notas as &$linea) {
        list($nid, $texto, $fecha, $completada) = explode('|', $linea);
        if ($nid == $id) {
            $linea = "$nid|$texto|$fecha|1";
        }
    }
    file_put_contents("notas.dat", implode("\n", $notas) . "\n");
}
elseif ($accion === "Guardar") {
    $id = $_POST['id'];
    $nuevoTexto = trim($_POST['nuevo_contenido']);
    foreach ($notas as &$linea) {
        list($nid, $texto, $fecha, $completada) = explode('|', $linea);
        if ($nid == $id) {
            $linea = "$nid|$nuevoTexto|$fecha|$completada";
        }
    }
    file_put_contents("notas.dat", implode("\n", $notas) . "\n");
}

header("Location: notas.php");
exit;
