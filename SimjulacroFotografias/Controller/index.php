<?php
require_once '../Model/Foto.php';
require_once '../Model/Like.php';
require_once '../Model/Usuario.php';
if (session_status() == PHP_SESSION_NONE) session_start();
//Si recibimos 'cerrar' cerramos la sesión del usuario
if (isset($_REQUEST['cerrar'])) {
    unset ($_SESSION['usuario']);
}
$fotos=Foto::getFotos();
foreach ($fotos as $foto) {
    $autor=Usuario::getUsuarioById($foto->getId_usuario())->getNombre();
    $likes=Like::getLikesByFoto($foto->getId());
    $data['fotos'][]=['id'=>$foto->getId(),'imagen'=>$foto->getImagen(), 'autor'=>$autor, 'likes'=>$likes];
}
// $data['fotoLikes']=Like::getFotoMasLikes(); //recupera la foto con más likes para resaltarla
if (isset($_SESSION['usuario'])) {
    $data['id_usuario']=Usuario::getUsuarioByNombre($_SESSION['usuario'])->getId();
    include '../View/index_user_V.php';
} else {
    include '../View/index_anonimo_V.php';
}
