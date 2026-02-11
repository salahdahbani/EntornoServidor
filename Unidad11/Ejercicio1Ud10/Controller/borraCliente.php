<?php
require_once '../Model/banco.php';
$clienteAux = new banco($_GET['DNI']);
$clienteAux->delete();
header("Location: ../Controller/index.php");
?>