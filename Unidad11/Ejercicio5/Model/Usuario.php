<?php
require_once 'CarritoBD.php';
class Usuario {
private $id;
private $nombre;
private $pass;
private $rol;

function __construct($id=0, $nombre="", $pass="", $rol="") {
$this->id = $id;
$this->nombre = $nombre;
$this->pass = $pass;
$this->rol = $rol;
}
public function getId() {
return $this->id;
}
public function getNombre() {
return $this->nombre;
}
public function getPass() {
return $this->pass;
}
public function getRol() {
return $this->rol;
}
public function insert() {
$conexion = CarritoBD::connectDB();
$insercion = "INSERT INTO usuarios ( nombre, pass, rol) VALUES ('$this->nombre','$this->pass','$this->rol')";
$conexion->exec($insercion);
$conexion=null;
}
public function delete() {
$conexion = CarritoBD::connectDB();
$borrado = "DELETE FROM usuarios WHERE id='$this->id'";
$conexion->exec($borrado);
$conexion=null;
}
public function update() {
$conexion = CarritoBD::connectDB();
$actualiza = "UPDATE usuarios SET nombre='$this->nombre', pass='$this->pass', rol='$this->rol' WHERE id='$this->id'";
$conexion->exec($actualiza);
$conexion=null;
}
public static function getUsuarios() {
$conexion = CarritoBD::connectDB();
$seleccion = "SELECT id, nombre, pass, rol FROM usuarios";
$consulta = $conexion->query($seleccion);
$productos = [];
while ($registro = $consulta->fetchObject()) {
$productos[] = new Usuario($registro->id, $registro->nombre, $registro->pass, $registro->rol);
}
$conexion=null;
return $productos;
}

public static function getUsuarioByNombre($nombre) {
    $conexion = CarritoBD::connectDB();
    $seleccion = "SELECT id, nombre, pass, rol FROM usuarios WHERE nombre='$nombre'";
    $consulta = $conexion->query($seleccion);

    if ($consulta->rowCount() > 0) {
        $registro = $consulta->fetchObject();
        return new Usuario($registro->id, $registro->nombre, $registro->pass, $registro->rol);
    }
    return false;
}

public static function getUsuarioById($id) {
$conexion = CarritoBD::connectDB();
$seleccion = "SELECT id, nombre, pass, rol FROM usuarios WHERE id=$id";
$consulta = $conexion->query($seleccion);
if ($consulta->rowCount()>0) {
$registro = $consulta->fetchObject();
$producto = new Usuario($registro->id, $registro->nombre, $registro->pass, $registro->rol);
$conexion=null;
return $producto;
}else{
$conexion=null;
return false;
}
}
}

?>