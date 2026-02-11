<?php
require_once '../Model/Usuario.php';
$usuarioAux = new Usuario("", $_POST['nombre'], $_POST['pass'], $_POST['rol']);
$usuarioAux->insert();
header("Location: ../Controller/login.php");