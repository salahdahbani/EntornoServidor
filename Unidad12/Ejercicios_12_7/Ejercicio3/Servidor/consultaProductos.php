<?php
require_once 'Producto.php';
$metodo = $_SERVER['REQUEST_METHOD'];
$codEstado=200;
$mensaje = "OK";
$devolver = [];
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
      $devolver[] = ['nombre' => $producto->getNombre(), 'precio' => $producto->getPrecio(), 'stock' => $producto->getStock()];
    }
  }
} else if ($metodo == 'POST') {
    $producto = Producto::getProductoByNombre($_REQUEST['nombre']);
    if ($producto) {
      $mensaje = "CONFLICTO, PRODUCTO CON MISMO NOMBRE";
      $codEstado = 409;
    }else{
      $producto = new Producto(null, $_REQUEST['nombre'], $_REQUEST['precio'], null, $_REQUEST['stock']);
      $producto->insert();
    }
}else if ($metodo == 'DELETE') {
  //Para los métodos GET y POST existe $_REQUEST, pero para PUT y DELETE no, así que tenemos que parsear el php://input
    parse_str(file_get_contents("php://input"),$parametros);
    $producto = Producto::getProductoByNombre($parametros['nombre']);
    if ($producto) {
      $producto->delete();
    }else {
      $mensaje = "PRODUCTO NO ENCONTRADO";
      $codEstado=404;
    }
}else if ($metodo == 'PUT') {
  //Para los métodos GET y POST existe $_REQUEST, pero para PUT y DELETE no, así que tenemos que parsear el php://input
    parse_str(file_get_contents("php://input"),$parametros);
    $producto = Producto::getProductoByNombre($parametros['nombre']);
    if ($producto) {
      $producto->añade($parametros['cantidad']);
    }else {
      $mensaje = "PRODUCTO NO ENCONTRADO";
      $codEstado=404;
    }
  }
 
  header("HTTP/1.1 $codEstado $mensaje");  
  header("Content-Type: application/json;charset=utf-8");  
  echo json_encode($devolver);
    