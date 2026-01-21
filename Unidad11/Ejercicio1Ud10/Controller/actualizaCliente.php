<?php
require_once '../Model/banco.php';
$data['clientes']=banco::getClientesbyDNI($_REQUEST['DNI']);
// Carga la vista del formulario de alta de cliente
include '../View/actualizaBanco_view.php';
?>