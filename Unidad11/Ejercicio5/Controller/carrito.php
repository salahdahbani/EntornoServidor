<?php require_once '../Model/Producto.php';
require_once '../Model/Usuario.php';
require_once '../Model/Cesta.php';
session_start();
if (!isset($_SESSION['id_usuario'])) {
    $id_num = 1; // ID de prueba si no hay sesión
    $data['usuario'] = Usuario::getUsuarioById(1);
} else {
    // Obtenemos el objeto Usuario
    $usuarioObjeto = Usuario::getUsuarioById($_SESSION['id_usuario']);
    // EXTRAEMOS el ID numérico
    $id_num = $usuarioObjeto->getId();
    // Guardamos el objeto para la vista
    $data['usuario'] = $usuarioObjeto;
}
// Pasamos el ID (ERROR QUE ME DABA ANTES), NO el objeto, a la consulta
$data['cesta'] = Cesta::getCestaByCliente($id_num);
$data['productos_info'] = Producto::getProductos();

// Guardamos el id_actual como número para los enlaces de la vista
$id_actual = $id_num; 

include '../View/carrito_view.php';