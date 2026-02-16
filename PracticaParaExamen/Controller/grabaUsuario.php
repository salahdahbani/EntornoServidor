<?php
require_once '../Model/Usuario.php';
$usuarioAux = new Usuario("", $_POST['nombre'], $_POST['rol']);
$usuarioAux->update();
header("Location: ../Controller/login.php");