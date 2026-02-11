<?php
// Carga la vista del formulario de alta de alumno
 require_once '../Model/Producto.php';
require_once '../Model/Usuario.php';
require_once '../Model/Cesta.php';

// Obtiene todas las asignaturas
$data['productos'] = Producto::getProductos();
$data['cesta'] = Cesta::getProductos();
if (isset($_REQUEST['id_cliente'])) {
    $id_cliente = $_REQUEST['id_cliente'];

    if ($id_cliente != '') { 
        $usuario = Usuario::getUsuarioById($id_cliente);
        if ($usuario) {
            $data['unUsuario'] = $usuario;
            $data['susProductos'] = $usuario->getProductoComp();
            //$data['productos_libres'] = Producto::getProductosLibres($id_cliente);
        }
    }
}
// Si se envía código de asignatura
if (isset($_REQUEST['cod_producto'])) {
    $codigo_producto = $_REQUEST['cod_producto'];
    if ($codigo_producto != '') { // comprobación simple
        // Buscar la asignatura en el array de asignaturas
        $producto = null;
        foreach ($data['productos'] as $a) {
            if ($a->getCodigo() == $codigo_producto) {
                $producto = $a;
            }
        }
        if ($producto) {
            $data['cesta'] = $producto;
        }
    }
}
// Obtiene todas las alumnos
$data['usuarios'] = Usuario::getUsuarios();
$nombre = $data['productos'][0]->getNombre();
$codigo = $data['productos'][0]->getCodigo();
include '../View/carrito_view.php';