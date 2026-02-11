<?php
require_once 'CarritoBD.php';
class Producto {
private $codigo;
private $nombre;
private $precio;
private $stock;
private $imagen;
function __construct($codigo=0, $nombre="", $precio=0, $stock=0, $imagen="") {
$this->codigo = $codigo;
$this->nombre = $nombre;
$this->precio = $precio;
$this->stock = $stock;
$this->imagen = $imagen;
}
public function getCodigo() {
return $this->codigo;
}
public function getNombre() {
return $this->nombre;
}
public function getPrecio() {
return $this->precio;
}
public function getStock() {
return $this->stock;
}
public function getImagen() {
return $this->imagen;
}
public function setStock($stock) {
    $this->stock = $stock;
}
public function insert() {
$conexion = CarritoBD::connectDB();
$insercion = "INSERT INTO carrito (nombre, precio, stock, imagen) VALUES ('$this->nombre','$this->precio','$this->stock','$this->imagen')";
$conexion->exec($insercion);
$conexion=null;
}
public function delete() {
$conexion = CarritoBD::connectDB();
$borrado = "DELETE FROM carrito WHERE codigo='$this->codigo'";
$conexion->exec($borrado);
$conexion=null;
}
public function update() {
$conexion = CarritoBD::connectDB();
$actualiza = "UPDATE carrito SET nombre='$this->nombre', precio='$this->precio', stock='$this->stock', imagen='$this->imagen' WHERE codigo='$this->codigo'";
$conexion->exec($actualiza);
$conexion=null;
}
public static function getProductos() {
$conexion = CarritoBD::connectDB();
$seleccion = "SELECT codigo, nombre, precio, stock, imagen FROM carrito";
$consulta = $conexion->query($seleccion);
$productos = [];
while ($registro = $consulta->fetchObject()) {
$productos[] = new Producto($registro->codigo, $registro->nombre, $registro->precio, $registro->stock, $registro->imagen);
}
$conexion=null;
return $productos;
}
public static function getProductoById($codigo) {
$conexion = CarritoBD::connectDB();
$seleccion = "SELECT codigo, nombre, precio, stock, imagen FROM carrito WHERE codigo=$codigo";
$consulta = $conexion->query($seleccion);
if ($consulta->rowCount()>0) {
$registro = $consulta->fetchObject();
$producto = new Producto($registro->codigo, $registro->nombre, $registro->precio, $registro->stock, $registro->imagen);
$conexion=null;
return $producto;
}else{
$conexion=null;
return false;
}
}
}

?>