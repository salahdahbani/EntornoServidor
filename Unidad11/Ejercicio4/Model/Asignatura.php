<?php
require_once 'EscuelaBD.php';
class Asignatura {
private $codigo;
private $nombre;
function __construct($codigo=0, $nombre="") {
$this->codigo = $codigo;
$this->nombre = $nombre;

}
public function getCodigo() {
return $this->codigo;
}
public function getNombre() {
return $this->nombre;
}

public function insert() {
$conexion = EscuelaBD::connectDB();
$insercion = "INSERT INTO asignatura (nombre) VALUES ('$this->nombre')";
$conexion->exec($insercion);
$conexion=null;
}
public function delete() {
$conexion = EscuelaBD::connectDB();
$borrado = "DELETE FROM asignatura WHERE codigo='$this->codigo'";
$conexion->exec($borrado);
$conexion=null;
}
public function update() {
$conexion = EscuelaBD::connectDB();
$actualiza = "UPDATE asignatura SET nombre='$this->nombre' WHERE codigo='$this->codigo'";
$conexion->exec($actualiza);
$conexion=null;
}
public static function getAsignaturas() {
$conexion = EscuelaBD::connectDB();
$seleccion = "SELECT codigo, nombre FROM asignatura";
$consulta = $conexion->query($seleccion);
$productos = [];
while ($registro = $consulta->fetchObject()) {
$productos[] = new Asignatura($registro->codigo, $registro->nombre);
}
$conexion=null;
return $productos;
}
public static function getAsignaturaById($codigo) {
$conexion = EscuelaBD::connectDB();
$seleccion = "SELECT codigo, nombre FROM asignatura WHERE codigo=$codigo";
$consulta = $conexion->query($seleccion);
if ($consulta->rowCount()>0) {
$registro = $consulta->fetchObject();
$producto = new Asignatura($registro->codigo, $registro->nombre);
$conexion=null;
return $producto;
}else{
$conexion=null;
return false;
}
}
}

?>