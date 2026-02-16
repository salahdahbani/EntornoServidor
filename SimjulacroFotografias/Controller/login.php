<?php
if (session_status() == PHP_SESSION_NONE) session_start();
require_once '../Model/Usuario.php';

//Si la sesion está iniciada redirige a index.php
if (isset($_SESSION['usuario'])) {
    header("location: ../Controller/index.php");
}
$data['mensaje']="";
//Si recibimos usuario y contraseña comprobamos para inciar sesión
if (isset($_REQUEST['login'])) {
    if ($usuario=Usuario::getUsuarioByNombre($_REQUEST['usuario'])){
        $_SESSION['usuario']=$usuario->getNombre();
        header("location: ../Controller/index.php");
    }else {
        $data['mensaje']="El usuario no está registrado";
    }
}else if (isset($_REQUEST['registro'])) {
    $_SESSION['usuario']=$_REQUEST['usuario'];
    $usuario= new Usuario(null, $_REQUEST['usuario']);
    $usuario->insert();
    header("location: ../Controller/index.php");
}
//carga la vista con el listado de productos
include '../View/login_V.php';