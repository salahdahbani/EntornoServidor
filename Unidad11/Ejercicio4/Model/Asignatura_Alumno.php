<?php
require_once 'EscuelaBD.php';
class Asignatura_Alumno {
private $matricula;
private $codigo_asignatura;
function __construct($matricula=0, $codigo_asignatura=0) {
$this->matricula = $matricula;
$this->codigo_asignatura = $codigo_asignatura;

}
public function getMatricula() {
return $this->matricula;
}
public function getCodigoAsignatura() {
return $this->codigo_asignatura;
}

public function insert() {
$conexion = EscuelaBD::connectDB();
$insercion = "INSERT INTO asignatura_alumno (matricula, codigo_asignatura) VALUES ('$this->matricula','$this->codigo_asignatura')";
$conexion->exec($insercion);
$conexion=null;
}
public function delete() {
$conexion = EscuelaBD::connectDB();
$borrado = "DELETE FROM asignatura_alumno WHERE matricula='$this->matricula' AND codigo_asignatura='$this->codigo_asignatura'";
$conexion->exec($borrado);
$conexion=null;
}
public function update() {
$conexion = EscuelaBD::connectDB();
$actualiza = "UPDATE asignatura_alumno SET matricula='$this->matricula', codigo_asignatura='$this->codigo_asignatura' WHERE matricula='$this->matricula' AND codigo_asignatura='$this->codigo_asignatura'";
$conexion->exec($actualiza);
$conexion=null;
}
public static function getAsignatura_alumno() {
$conexion = EscuelaBD::connectDB();
$seleccion = "SELECT matricula, codigo_asignatura FROM asignatura_alumno";
$consulta = $conexion->query($seleccion);
$productos = [];
while ($registro = $consulta->fetchObject()) {
$productos[] = new Asignatura_Alumno($registro->matricula, $registro->codigo_asignatura);
}
$conexion=null;
return $productos;
}
public static function getAsignatura_alumnoById($matricula, $codigo_asignatura) {
$conexion = EscuelaBD::connectDB();
$seleccion = "SELECT matricula, codigo_asignatura FROM asignatura_alumno WHERE matricula=$matricula AND codigo_asignatura=$codigo_asignatura";
$consulta = $conexion->query($seleccion);
if ($consulta->rowCount()>0) {
$registro = $consulta->fetchObject();
$producto = new Asignatura_Alumno($registro->matricula, $registro->codigo_asignatura);
$conexion=null;
return $producto;
}else{
$conexion=null;
return false;
}
}
}

?>