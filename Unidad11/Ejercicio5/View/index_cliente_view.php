<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Listado de productos</title>
</head>
<body>
    <h1>Bienvenido, <?= $data['usuario']->getNombre() ?? 'Invitado' ?></h1>
    <hr>
    <table border="1">
        <tr>
            <td>Código</td>
            <td>Nombre</td>
            <td>Precio</td>
            <td>Stock</td>
            <td>Imagen</td>
            <td><a href="../Controller/carrito.php">Ver Carrito</a></td>
        </tr>
    <?php foreach($data['productos'] as $producto) { ?>
        <tr>
            <td><?=$producto->getCodigo()?></td>
            <td><?=$producto->getNombre()?></td>
            <td><?=$producto->getPrecio()?> €</td>
            <td><?=$producto->getStock()?></td>
            <td><img src="../View/Images/<?=$producto->getImagen()?>" width="100"></td>
            <td>
                <?php if (isset($_SESSION['id_usuario'])){ ?>
                    <a href="../Controller/grabarCompra.php?codigo=<?=$producto->getCodigo()?>&id_cliente=<?=$_SESSION['id_usuario']?>">
                        Comprar
                    </a>
                <?php } ?>
            </td>
        </tr>
    <?php } ?>
    </table>
    <hr>
    <a href="../Controller/logout.php">Cerrar Sesión</a>
</body>
</html>