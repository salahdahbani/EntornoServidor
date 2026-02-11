<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Carrito por Usuario</title>
</head>
<body>
    <h1>Mi Carrito</h1>
    <h3>Usuario <?= $data['usuario']->getNombre() ?></h3>
    <hr>

    <?php if (count($data['cesta']) > 0) { ?>
        <table border="1">
            <tr>
                <th>Producto</th>
                <th>Imagen</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Acción</th>
            </tr>
            <?php 
            $total = 0;
            foreach ($data['cesta'] as $itemCesta){
                // Buscamos los detalles (nombre, foto) del producto
                $productoDetalle = null;
                foreach ($data['productos_info'] as $p) {
                    if ($p->getCodigo() == $itemCesta->getCod_producto()) {
                        $productoDetalle = $p;
                    }
                }

                if ($productoDetalle){
                    $total += $productoDetalle->getPrecio();
            ?>
                <tr>
                    <td><?= $productoDetalle->getNombre() ?></td>
                    <td>
                        <img src="../View/images/<?= $productoDetalle->getImagen() ?>" width="80">
                    </td>
                    <td><?php
                     if (isset($_POST['codigo']) && $_POST['codigo'] == $productoDetalle->getCodigo()) {
                            // Si se acaba de añadir o quitar, recalcular la cantidad
                            $cantidad = 0;
                            foreach (Cesta::getCestaByCliente($id_actual) as $ic) {
                                if ($ic->getCod_producto() == $productoDetalle->getCodigo()) {
                                    $cantidad++;
                                }
                            }
                            echo $cantidad;
                        } else {
                            // Cantidad inicial
                            $cantidad = 0;
                            foreach (Cesta::getCestaByCliente($id_actual) as $ic) {
                                if ($ic->getCod_producto() == $productoDetalle->getCodigo()) {
                                    $cantidad++;
                                }
                            }
                            echo $cantidad;
                        }
                     ?></td>
                    <td><?= $productoDetalle->getPrecio() ?> €</td>
                    <td>
                        <a href="../Controller/borrar_item.php?id_c=<?= $id_actual ?>&cod_p=<?= $productoDetalle->getCodigo() ?>">
                            Eliminar del carrito
                        </a>
                    </td>
                </tr>
            <?php }
            }
             ?>
            <tr>
                <td colspan="2"><strong>TOTAL DE LA COMPRA</strong></td>
                <td colspan="2"><strong><?= number_format($total, 2) ?> €</strong></td>
            </tr>
        </table>
    <?php }else { ?>
        <p>Tu carrito está vacío. ¡Añade algún producto!</p>
    <?php } ?>

    <br>
    <hr>
    <a href="../Controller/index_cliente.php">Continuar comprando</a>
</body>
</html>