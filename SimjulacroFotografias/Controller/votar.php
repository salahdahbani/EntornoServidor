<?php
   require_once '../Model/Like.php';
   require_once '../Model/Usuario.php';
   if (session_status() == PHP_SESSION_NONE) session_start();
   $usuario=Usuario::getUsuarioByNombre($_SESSION['usuario']);
   $like=new Like ($_REQUEST['id_foto'], $usuario->getId());
   $like->insert();
   header('location: ../Controller/index.php');