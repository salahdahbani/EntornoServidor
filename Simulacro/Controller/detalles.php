<?php
session_start();

require_once '../Model/Foto.php';
require_once '../Model/Usuario.php';
require_once '../Model/Like.php';

if(isset($_GET['id_foto']) && isset($_GET['id_usuario'])){
    $id_foto = $_GET['id_foto'];
    $id_usuario = $_GET['id_usuario'];

    // 1. Cargamos la foto
    $data['foto'] = Foto::getFotoById($id_foto);
    
    // 2. Cargamos el autor (El que pasamos por la URL)
    $data['usuario'] = Usuario::getUsuarioById($id_usuario); 
    
    // 3. Cargamos los likes
    $data['usuarios_con_like'] = Like::getUsuarioFotos($id_foto);


    }

include '../View/detalles_view.php';
