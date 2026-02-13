<?php
require_once 'Producto.php';

$token = $_REQUEST['token'] ?? '';


if (!Producto::validarToken($token)) {
  header("HTTP/1.1 401 Unauthorized");
  echo json_encode(["error" => "Token no valido o ausente. Acceso denegado."]);
  exit;
}
$metodo = $_SERVER['REQUEST_METHOD'];
$codEstado = 200;
$mensaje = "OK";
if ($metodo == 'GET') {
  if (isset($_REQUEST['min']) && isset($_REQUEST['max'])) {
    $productos = Producto::getProductosFiltroPrecio($_REQUEST['min'], $_REQUEST['max']);
  } else if (isset($_REQUEST['nombre'])) {
    $productos = Producto::getProductosFiltroNombre($_REQUEST['nombre']);
  }
  if (count($productos) == 0) {
    $mensaje = "PRODUCTO NO ENCONTRADO";
    $codEstado = 404;
  } else {

    foreach ($productos as $producto) {
      $devolver[] = [
        'nombre' => $producto->getNombre(),
        'precio' => $producto->getPrecio(),
        'urlImg' => $producto->getUrlImg()
      ];
    }
  }
}

setCabecera($codEstado, $mensaje);
if ($codEstado == 200) {
  echo json_encode($devolver);
}

function setCabecera($codEstado, $mensaje)
{
  header("HTTP/1.1 $codEstado $mensaje");
  header("Content-Type: application/json;charset=utf-8");
}
