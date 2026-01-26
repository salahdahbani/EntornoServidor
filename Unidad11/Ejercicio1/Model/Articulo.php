<?php
require_once 'BlogBD.php';
class Articulo {
private $id;
private $titulo;
private $fecha;
private $contenido;
function __construct($id=0, $titulo="", $fecha="", $contenido="") {
$this->id = $id;
$this->titulo = $titulo;
$this->fecha = date("Y-m-d");
$this->contenido = $contenido;
}
public function getId() {
return $this->id;
}
public function getTitulo() {
return $this->titulo;
}
public function getFecha() {
return $this->fecha;
}
public function getContenido() {
return $this->contenido;
}
public function insert() {
$conexion = BlogBD::connectDB();
$insercion = "INSERT INTO blog (titulo, fecha, contenido) VALUES ('$this->titulo','$this->fecha','$this->contenido')";
$conexion->exec($insercion);
$conexion=null;
}
public function delete() {
$conexion = BlogBD::connectDB();
$borrado = "DELETE FROM blog WHERE id='$this->id'";
$conexion->exec($borrado);
$conexion=null;
}
public function update() {
$conexion = BlogBD::connectDB();
$actualiza = "UPDATE blog SET titulo='$this->titulo', fecha='$this->fecha', contenido='$this->contenido'
WHERE id='$this->id'";
$conexion->exec($actualiza);
$conexion=null;
}
public static function getArticulos() {
$conexion = BlogBD::connectDB();
$seleccion = "SELECT id, titulo, fecha, contenido FROM blog";
$consulta = $conexion->query($seleccion);
$articulos = [];
while ($registro = $consulta->fetchObject()) {
$articulos[] = new Articulo($registro->id, $registro->titulo, $registro->fecha, $registro->contenido);
}
$conexion=null;
return $articulos;
}
public static function getArticuloById($id) {
$conexion = BlogBD::connectDB();
$seleccion = "SELECT id, titulo, fecha, contenido FROM blog WHERE id=$id";
$consulta = $conexion->query($seleccion);
if ($consulta->rowCount()>0) {
$registro = $consulta->fetchObject();
$articulo = new Articulo($registro->id, $registro->titulo, $registro->fecha, $registro->contenido);
$conexion=null;
return $articulo;
}else{
$conexion=null;
return false;
}
}
}

?>