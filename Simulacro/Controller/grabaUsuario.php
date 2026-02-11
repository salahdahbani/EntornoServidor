<?php
require_once '../Model/Usuario.php';
$usuarioAux = new Usuario("", $_POST['nombre']);
$usuarioAux->insert();
header("Location: ../Controller/login.php");