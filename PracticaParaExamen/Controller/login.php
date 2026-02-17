<?php require_once '../Model/Usuario.php';
if (session_status() == PHP_SESSION_NONE) session_start();
//Si la sesion está iniciada redirige a index.php
if (isset($_SESSION['usuario'])) {
    header("location: ../Controller/index.php");
}
$data['mensaje']="";
//Si recibimos usuario y contraseña comprobamos para inciar sesión
if (isset($_REQUEST['login'])) {
    if ($usuario = Usuario::getUsuarioByNombre($_REQUEST['usuario'])){
    $_SESSION['usuario'] = $usuario->getNombre();
    $_SESSION['usuario_id'] = $usuario->getId(); // ¡Añade esto!
    $_SESSION['rol'] = $_REQUEST['rol']; // Para que el técnico vea cosas distintas
    header("location: ../Controller/index.php");
    }else {
        $data['mensaje']="El usuario no está registrado";
    }
}else if (isset($_REQUEST['registro'])) {
    $_SESSION['usuario']=$_REQUEST['usuario'];
    $usuario= new Usuario(null, $_REQUEST['usuario'], $_REQUEST['rol']);
    $usuario->insert();
    header("location: ../Controller/index.php");
}
    include("../View/iniciosesion_view.php");


