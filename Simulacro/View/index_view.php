<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Listado de productos</title>
    <style>
        /* Estilo base del botón */
        .btn-votar {
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            color: #333;
            transition: all 0.3s ease;
        }

        /* Estilo cuando ya está VOTADO */
        .votado {
            background-color: #ff4757; /* Rojo */
            color: white !important;
            border-color: #e84118;
        }

        table { border-collapse: collapse; width: 100%; }
        th, td { padding: 10px; text-align: center; }
    </style>
</head>
<body>
    <h1>Galería de Imágenes</h1>
    <hr>
    <table border="1">
        <tr>
            <th>Imagen</th>
            <th>Autor</th>
            <th>Likes</th>
            <th>Votar</th>
        </tr>
        <?php
        foreach($data['usuario'] as $usuario) {
            foreach($data['foto'] as $foto) {
                if($foto->getId_usuario() == $usuario->getId()) { 
                    
                    // Lógica para el estado del botón
                    $yaVotado = in_array($foto->getId(), $data['likes_usuario']);
                    $claseCss = $yaVotado ? "btn-votar votado" : "btn-votar";
                    $texto = $yaVotado ? "★ Votado" : "☆ Votar";
                    
                    // Lógica para contar likes totales de esta foto
                    $totalLikes = Like::countLikesByFoto($foto->getId());
        ?>
                    <tr>
                        <td>
                            <a href="../Controller/detalles.php?id_foto=<?=$foto->getId()?>&id_usuario=<?=$usuario->getId()?>">
                                <img src="../View/imagen/<?=$foto->getImagen()?>" width="100">
                            </a>
                        </td>
                        <td><?=$usuario->getNombre()?></td>

    <td>
        <?= Like::countLikesByFoto($foto->getId()) ?>
    </td>

    <td>
        <?php 
            // Verificamos si la ID de la foto actual está en el array de likes del usuario
            $yaVotado = in_array($foto->getId(), $data['likes_usuario']);
            
            $claseCss = $yaVotado ? "btn-votar votado" : "btn-votar";
            $texto = $yaVotado ? "★ Votado" : "☆ Votar";
        ?>
        <a class="<?= $claseCss ?>" href="../Controller/votar.php?id_foto=<?= $foto->getId() ?>">
            <?= $texto ?>
        </a>
    </td>
                    </tr>
        <?php
                } 
            } 
        } 
        ?>
    </table>
    <br>
    <hr>
    <a href="../Controller/nuevoProducto.php">Nuevo producto</a>
    <br>
    <a href="../Controller/logout.php">Volver al inicio</a>
</body>
</html>