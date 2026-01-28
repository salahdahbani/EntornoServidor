<?php
require_once 'EscuelaBD.php';
require_once 'Asignatura.php';
require_once 'Asignatura_Alumno.php';
class Alumno {
private $matricula;
private $nombre;
private $apellido;
private $curso;
function __construct($matricula="", $nombre="", $apellido="", $curso="") {
$this->matricula = $matricula;
$this->nombre = $nombre;
$this->apellido = $apellido;
$this->curso = $curso;
}
public function getMatricula() {
return $this->matricula;
}
public function getNombre() {
return $this->nombre;
}
public function getApellido() {
return $this->apellido;
}
public function getCurso() {
return $this->curso;
}
public function insert() {
$conexion = EscuelaBD::connectDB();
$consulta = $conexion->query("SELECT matricula FROM alumno WHERE matricula='$this->matricula'");
if ($consulta->rowCount() == 0) {
$insercion = "INSERT INTO alumno (matricula, nombre, apellido, curso) VALUES ('$this->matricula','$this->nombre','$this->apellido','$this->curso')";
$conexion->exec($insercion);
}else{
    echo "Ya existe un alumno con matrícula " . $this->matricula . "<br>";
}
$conexion=null;
}
public function delete() {
$conexion = EscuelaBD::connectDB();
$borrado = "DELETE FROM alumno WHERE matricula='$this->matricula'";
$conexion->exec($borrado);
$conexion=null;
}
public function getAsignaturaMat() {
$conexion = EscuelaBD::connectDB();
$seleccion = "SELECT * FROM asignatura JOIN asignatura_alumno ON asignatura.codigo = asignatura_alumno.codigo_asignatura WHERE asignatura_alumno.matricula='$this->matricula'";
$consulta = $conexion->query($seleccion);
$asignaturas = [];
while ($registro = $consulta->fetchObject()) {
$asignaturas[] = new Asignatura($registro->codigo, $registro->nombre);
}
$conexion=null;
return $asignaturas;
}
public function update() {
$conexion = EscuelaBD::connectDB();
$actualiza = "UPDATE alumno SET nombre='$this->nombre', apellido='$this->apellido', curso='$this->curso' WHERE matricula='$this->matricula'";
$conexion->exec($actualiza);
$conexion=null;
}
public static function getAlumnos() {
$conexion = EscuelaBD::connectDB();
$seleccion = "SELECT matricula, nombre, apellido, curso FROM alumno";
$consulta = $conexion->query($seleccion);
$productos = [];
while ($registro = $consulta->fetchObject()) {
$productos[] = new Alumno($registro->matricula, $registro->nombre, $registro->apellido, $registro->curso);
}
$conexion=null;
return $productos;
}
public static function getAlumnoById($matricula) {
$conexion = EscuelaBD::connectDB();
$seleccion = "SELECT matricula, nombre, apellido, curso FROM alumno WHERE matricula='$matricula'";
$consulta = $conexion->query($seleccion);
if ($consulta->rowCount()>0) {
$registro = $consulta->fetchObject();
$producto = new Alumno($registro->matricula, $registro->nombre, $registro->apellido, $registro->curso);
$conexion=null;
return $producto;
}else{
$conexion=null;
return false;
}
}
}

?>