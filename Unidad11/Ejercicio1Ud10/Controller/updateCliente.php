<?php
require_once '../Model/banco.php';
$cliente=banco::getClientesbyDNI($_REQUEST['DNI']);
// actualiza la oferta en la base de datos
$clienteAux = new banco($_REQUEST['DNI'], $_POST['nombre'], $_POST['direccion'], $_POST['telefono']);
$clienteAux->update();
header("Location: ../Controller/index.php");
?>