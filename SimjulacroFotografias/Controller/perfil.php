<?php
require_once '../Model/Foto.php';
require_once '../Model/Like.php';
require_once '../Model/Usuario.php';
if (session_status() == PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['usuario'])) {
    header("location: ../Controller/index.php");
}
$usuario=Usuario::getUsuarioByNombre($_SESSION['usuario']);
if (isset($_REQUEST['insertar'])) {
    // sube la imagen al servidor
    move_uploaded_file($_FILES["imagen"]["tmp_name"], "../View/imagen/" . $_FILES["imagen"]["name"]);
  
    // inserta la oferta en la base de datos
    $foto = new Foto(null, $_FILES["imagen"]["name"],$usuario->getId());
    $foto->insert();
}
$fotos=Foto::getFotosByUsu($usuario->getId());
$data['fotos']=[];
foreach ($fotos as $foto) {
    $likes=Like::getLikesByFoto($foto->getId());
    $data['fotos'][]=['imagen'=>$foto->getImagen(), 'likes'=>$likes];
}
include '../View/perfil_V.php';
