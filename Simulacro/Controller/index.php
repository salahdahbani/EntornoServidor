<?php
session_start(); // Se inicia aquí UNA SOLA VEZ

require_once '../Model/Foto.php';
require_once '../Model/Usuario.php';
require_once '../Model/Like.php';
if (session_status() == PHP_SESSION_NONE) session_start();
//Si recibimos 'cerrar' cerramos la sesión del usuario
if (isset($_REQUEST['cerrar'])) {
    unset ($_SESSION['usuario']);
}
$fotos=Foto::getFotos();
foreach ($fotos as $foto) {
    $autor=Usuario::getUsuarioById($foto->getId_usuario())->getNombre();
    $likes=Like::countLikesByFoto($foto->getId());
    $data['fotos'][]=['id'=>$foto->getId(),'imagen'=>$foto->getImagen(), 'autor'=>$autor, 'likes'=>$likes];
}
// $data['fotoLikes']=Like::getFotoMasLikes(); //recupera la foto con más likes para resaltarla
if (isset($_SESSION['usuario'])) {
    $data['id_usuario']=Usuario::getUsuarioByNombre($_SESSION['usuario'])->getId();
    include '../View/index_view.php';
} else {
    include '../View/index_anonimo_view.php';
}