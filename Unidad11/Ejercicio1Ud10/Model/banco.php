<?php
require_once 'ClientesDB.php';
class banco {
private $DNI;
private $Nombre;
private $Direccion;
private $Telefono;
function __construct($DNI=0, $Nombre="", $Direccion="", $Telefono=0) {
$this->DNI = $DNI;
$this->Nombre = $Nombre;
$this->Direccion = $Direccion;
$this->Telefono = $Telefono;
}
public function getDNI() {
return $this->DNI;
}
public function getNombre() {
return $this->Nombre;
}
public function getDireccion() {
return $this->Direccion;
}
public function getTelefono() {
return $this->Telefono;
}
public function insert() {
$conexion = ClientesDB::connectDB();
$insercion = "INSERT INTO clientes (DNI, Nombre, Direccion, Telefono) VALUES ('$this->DNI',
'$this->Nombre','$this->Direccion','$this->Telefono')";
$conexion->exec($insercion);
$conexion=null;
}
public function delete() {
$conexion = ClientesDB::connectDB();
$borrado = "DELETE FROM clientes WHERE DNI='$this->DNI'";
$conexion->exec($borrado);
$conexion=null;
}
public function update() {
$conexion = ClientesDB::connectDB();
$actualiza = "UPDATE clientes SET DNI='$this->DNI', Nombre='$this->Nombre', Direccion='$this->Direccion',
Telefono='$this->Telefono'
WHERE DNI='$this->DNI'";
$conexion->exec($actualiza);
$conexion=null;
}
public static function getClientes() {
$conexion = ClientesDB::connectDB();
$seleccion = "SELECT DNI, Nombre, Direccion, Telefono FROM clientes";
$consulta = $conexion->query($seleccion);
$banco = [];
while ($registro = $consulta->fetchObject()) {
$banco[] = new banco($registro->DNI, $registro->Nombre, $registro->Direccion, $registro->Telefono);
}
$conexion=null;
return $banco;
}
public static function getClientesbyDNI($DNI) {
$conexion = ClientesDB::connectDB();
$seleccion = "SELECT DNI, Nombre, Direccion, Telefono FROM clientes WHERE DNI='$DNI'";
$consulta = $conexion->query($seleccion);
if ($consulta->rowCount()>0) {
$registro = $consulta->fetchObject();
$banco = new banco($registro->DNI, $registro->Nombre, $registro->Direccion, $registro->Telefono);
$conexion=null;
return $banco;
}else{
$conexion=null;
return false;

}
}
}
?>