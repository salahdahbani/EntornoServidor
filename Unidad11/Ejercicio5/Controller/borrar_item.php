<?php
require_once '../Model/Cesta.php';

$id_c = $_GET['id_c'];
$cod_p = $_GET['cod_p'];

$item = new Cesta($id_c, $cod_p);
$item->delete();

header("Location: ../Controller/carrito.php");