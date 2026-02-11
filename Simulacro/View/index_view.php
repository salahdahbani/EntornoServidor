<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Listado de productos</title>
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
                // Solo creamos la fila SI el ID del usuario coincide con el de la foto
                if($foto->getId_usuario() == $usuario->getId()) { 
        ?>
                    <tr>
                        <td>
                            <a href="../Controller/detalles.php?id_foto=<?=$foto->getId()?>&id_usuario=<?=$usuario->getId()?>">
                                <img src="../View/Images/<?=$foto->getImagen()?>" width="100">
                            </a>
                        </td>
                        <td><?=$usuario->getNombre()?></td>
                        <td>
                            <?php 
                                // Aquí podrías contar los likes en el futuro
                                echo "0"; 
                            ?>
                        </td>
                        <td>
                            <a href="../Controller/votar.php?id_foto=<?=$foto->getId()?>">Votar</a>
                        </td>
                    </tr>
        <?php
                } // Fin del if
            } // Fin foreach fotos
        } // Fin foreach usuarios
        ?>
    </table>
    <br>
    <hr>
    <a href="../Controller/nuevoProducto.php">Nuevo producto</a>
    <br>
    <a href="../Controller/logout.php">Volver al inicio</a>
</body>
</html>