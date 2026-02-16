<?php
session_start();

require_once '../Model/Foto.php';
require_once '../Model/Usuario.php';
require_once '../Model/Like.php';

if(isset($_GET['id_foto']) && isset($_GET['id_usuario'])){
    $id_foto = $_GET['id_foto'];
    $id_usuario = $_GET['id_usuario'];


    $data['foto'] = Foto::getFotoById($id_foto);
    
    $data['usuario'] = Usuario::getUsuarioById($id_usuario); 

    $data['usuarios_con_like'] = Like::getUsuarioFotos($id_foto);


    }

include '../View/detalles_view.php';
