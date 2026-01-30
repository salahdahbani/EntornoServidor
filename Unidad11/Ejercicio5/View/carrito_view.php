<?php
require_once '../Model/Cesta.php';
require_once '../Model/Producto.php';

// 1. Identificar al usuario (debe estar en la sesión tras el login)
if (!isset($_SESSION['id_usuario'])) {
    // Si no hay sesión, podrías redirigir al login o usar un ID de prueba para testear
    // header("Location: login.php"); exit;
    $id_actual = 1; // ID de prueba
} else {
    $id_actual = $_SESSION['id_usuario'];
}

// 2. Lógica de persistencia (opcional: si quieres que los botones + y - graben en BD)
if (isset($_POST['codigo'])) {
    $codigo = $_POST['codigo'];
    if (isset($_POST['mas'])) {
        $nuevaRelacion = new Cesta($id_actual, $codigo);
        $nuevaRelacion->insert();
    }
    if (isset($_POST['menos'])) {
        $itemABorrar = new Cesta($id_actual, $codigo);
        $itemABorrar->delete(); // Borra una unidad
    }
}

// 3. Obtener los datos REALES del carrito de este usuario desde la BD
$data['cesta'] = Cesta::getCestaByCliente($id_actual);
$data['productos_info'] = Producto::getProductos();
?>

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

    <?php if (count($data['cesta']) > 0): ?>
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
    <?php else: ?>
        <p>Tu carrito está vacío. ¡Añade algún producto!</p>
    <?php endif; ?>

    <br>
    <hr>
    <a href="../Controller/index_cliente.php">Continuar comprando</a>
</body>
</html>