<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Listado de productos</title>
</head>
<body>
<h1>Detalles de la imagen</h1>
<img src="../View/imagen/<?=$data['foto']->getImagen()?>" width="100">
<<<<<<< Updated upstream
<p>Publicado por: <strong><?= $data['usuario']->getNombre() ?></strong></p>
=======
<p>Autor: <?= $data['usuario']->getNombre() ?></p>
>>>>>>> Stashed changes
<hr>
<p>Usuarios que han dado like:</p>
<br>
<?php
<<<<<<< Updated upstream
 if (empty($data['usuarios_con_like'])){?>
        <p>Nadie ha dado like todavía.</p>
    <?php } else{ ?>
=======
 if (empty($data['usuarios_con_like'])){ ?>
        <p>Nadie ha dado like todavía.</p>
    <?php }else{ ?>
>>>>>>> Stashed changes
        <ul>
            <?php foreach($data['usuarios_con_like'] as $usuarioLike) { ?>
                <li><?= $usuarioLike->getNombre() ?></li>
            <?php } ?>
        </ul>
    <?php } ?>

    <hr>
    <br>
    <a href="../Controller/index.php">
        <button type="button">Página Principal</button>
    </a></body>
</html>