<?php
require_once '../Model/Articulo.php';
$data['articulo']=Articulo::getArticuloById($_REQUEST['id']);
// Carga la vista del formulario de alta de articulo
include '../View/actualizaBlog_view.php';