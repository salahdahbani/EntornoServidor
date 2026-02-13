<?php
session_start();

require_once '../Model/Like.php';

// 1. Validar que el usuario esté logueado
if (!isset($_SESSION['id_usuario'])) { // Usamos id_usuario que es lo que necesitas abajo
    header("Location: ../index.php?error=debes_loguearte");
}

// 2. Obtener los datos necesarios
$id_foto = $_GET['id_foto'] ?? null;
$id_usuario = $_SESSION['id_usuario']; 

if (isset($_GET['id_foto'])) {
    // 3. Lógica de Toggle
    // Importante: Verifica que el método se llame exactamente así en tu modelo
    $existe = Like::getLikeById($id_usuario, $id_foto);

    if ($existe) {
        Like::borrarLike($id_usuario, $id_foto);
    } else {
        $nuevoLike = new Like($id_usuario, $id_foto);
        $nuevoLike->insert();
    }
}

// 4. Redirigir de vuelta
header("Location: ../Controller/index.php");
exit();