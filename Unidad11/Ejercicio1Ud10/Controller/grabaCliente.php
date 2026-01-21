<?php
require_once '../Model/banco.php';

// Creamos el objeto con los datos del formulario (nuevoBanco_view.php)
// Nota: En el formulario usaste name="dni" en minúsculas
$clienteAux = new banco($_POST['dni'], $_POST['nombre'], $_POST['direccion'], $_POST['telefono']);

$clienteAux->insert();

header("Location: ../Controller/index.php");
?>