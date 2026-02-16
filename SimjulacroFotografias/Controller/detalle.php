<?php
   require_once '../Model/Foto.php';
   require_once '../Model/Like.php';
   require_once '../Model/Usuario.php';
   if (session_status() == PHP_SESSION_NONE) session_start();
   if (!isset($_REQUEST['id'])) {
    header('location: ../Controller/index.php');
   }
   $data['foto']=Foto::getFotoById($_REQUEST['id']);
   $data['autor']=Usuario::getUsuarioById($data['foto']->getId_usuario())->getNombre();
   $data['usuarios']=Like::getUsersByLikesFoto($_REQUEST['id']);
   include '../View/detalle_V.php';