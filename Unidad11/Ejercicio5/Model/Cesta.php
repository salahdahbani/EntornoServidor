<?php
require_once 'CarritoBD.php';
require_once 'Producto.php';
require_once 'Usuario.php';
class Cesta {
private $id_cliente;
private $cod_producto;


function __construct($id_cliente=0, $cod_producto=0) {
$this->id_cliente = $id_cliente;
$this->cod_producto = $cod_producto;
}
public function getId_cliente() {
return $this->id_cliente;
}
public function getCod_producto() {
return $this->cod_producto;
}

public function insert() {
$conexion = CarritoBD::connectDB();
$insercion = "INSERT INTO cesta (id_cliente, cod_producto) VALUES ('$this->id_cliente','$this->cod_producto')";
$conexion->exec($insercion);
$conexion=null;
}
public function delete() {
$conexion = CarritoBD::connectDB();
$borrado = "DELETE FROM cesta WHERE id_cliente='$this->id_cliente' AND cod_producto='$this->cod_producto'";
$conexion->exec($borrado);
$conexion=null;
}
public static function getProductos() {
$conexion = CarritoBD::connectDB();
$seleccion = "SELECT * FROM cesta";
$consulta = $conexion->query($seleccion);
$productos = [];
while ($registro = $consulta->fetchObject()) {
$productos[] = new Cesta($registro->id_cliente, $registro->cod_producto);
}
$conexion=null;
return $productos;
}
public static function getCesta() {
$conexion = CarritoBD::connectDB();
$seleccion = "SELECT id_cliente, cod_producto FROM cesta";
$consulta = $conexion->query($seleccion);
$productos = [];
while ($registro = $consulta->fetchObject()) {
$productos[] = new Cesta($registro->id_cliente, $registro->cod_producto);
}
$conexion=null;
return $productos;
}
public static function getCestaById($id_cliente, $cod_producto) {
$conexion = CarritoBD::connectDB();
$seleccion = "SELECT * FROM cesta WHERE id_cliente='$id_cliente' AND cod_producto='$cod_producto'";
$consulta = $conexion->query($seleccion);
if ($consulta->rowCount() > 0) {
$registro = $consulta->fetchObject();
return new Cesta($registro->id_cliente, $registro->cod_producto);
}
$conexion=null;
return false;
}
public static function getCestaByCliente($id_cliente) {
$conexion = CarritoBD::connectDB();
$seleccion = "SELECT * FROM cesta WHERE id_cliente='$id_cliente'";
$consulta = $conexion->query($seleccion);
$productos = [];
while ($registro = $consulta->fetchObject()) {
$productos[] = new Cesta($registro->id_cliente, $registro->cod_producto);
}
$conexion=null;
return $productos;
}
public static function getClienteProductos($cod_producto) {
$conexion = CarritoBD::connectDB();
$seleccion = "SELECT * FROM usuarios WHERE id IN (SELECT id_cliente FROM cesta WHERE cod_producto='$cod_producto')";
$consulta = $conexion->query($seleccion);
$productos = [];
while ($registro = $consulta->fetchObject()) {
$productos[] = new Usuario($registro->id, $registro->nombre, $registro->email);
}
$conexion=null;
return $productos;
}
}

?>