<?php
session_start();
require_once '../Model/Cesta.php';
require_once '../Model/Producto.php';

if (isset($_GET['codigo']) && isset($_GET['id_cliente'])) {
    $codigo = $_GET['codigo'];
    $id_cliente = $_GET['id_cliente'];

    // 1. Verificar si hay stock antes de añadir
    $producto = Producto::getProductoById($codigo);
    
    if ($producto && $producto->getStock() > 0) {
        // 2. Insertar en la tabla 'cesta' de la base de datos
        $nuevaCompra = new Cesta($id_cliente, $codigo);
        $nuevaCompra->insert();

        // 3. Opcional: Restar stock en la tabla 'productos'
        $producto->setStock($producto->getStock() - 1);
        $producto->update();

        // 4. Redirigir al carrito para ver que se ha añadido
        header("Location: ../Controller/carrito.php");
    } else {
        echo "<script>alert('Sin stock'); window.history.back();</script>";
    }
}