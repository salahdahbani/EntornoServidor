<?php
require_once 'EscuelaBD.php';
require_once 'Alumno.php';
require_once 'Asignatura.php';
class Asignatura_Alumno {
private $matricula;
private $codigo_asignatura;
function __construct($matricula="", $codigo_asignatura="") {
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
$insercion = "INSERT INTO asignatura_alumno VALUES ('$this->matricula', '$this->codigo_asignatura')";
$conexion->exec($insercion);
$conexion=null;
}
public function delete() {
$conexion = EscuelaBD::connectDB();
$borrado = "DELETE FROM asignatura_alumno WHERE matricula='$this->matricula' AND codigo_asignatura='$this->codigo_asignatura'";
$conexion->exec($borrado);
$conexion=null;
}   
public static function getAsignaturas() {
$conexion = EscuelaBD::connectDB();
$seleccion = "SELECT * FROM asignatura_alumno";
$consulta = $conexion->query($seleccion);
$productos = [];
while ($registro = $consulta->fetchObject()) {
$productos[] = new Asignatura_Alumno($registro->matricula, $registro->codigo_asignatura);
}
$conexion=null;
return $productos;
}
public static function getAsignaturaLibres($matricula) {
$conexion = EscuelaBD::connectDB();
$seleccion = "SELECT * FROM asignatura WHERE codigo NOT IN (SELECT codigo_asignatura FROM asignatura_alumno WHERE matricula='$matricula')";
$consulta = $conexion->query($seleccion);
$asignaturasLibres = [];   
while ($registro = $consulta->fetchObject()) {
$asignaturasLibres[] = new Asignatura_Alumno($matricula, $registro->codigo);
 }
$conexion=null;
return $asignaturasLibres;
}

public static function getAlumnoMatriculados($codigo_asignatura) {
$conexion = EscuelaBD::connectDB();
$seleccion = "SELECT * FROM alumno WHERE matricula IN (SELECT matricula FROM asignatura_alumno WHERE codigo_asignatura='$codigo_asignatura')";
$consulta = $conexion->query($seleccion);
$productos = [];
while ($registro = $consulta->fetchObject()) {
$productos[] = new Alumno($registro->matricula, $registro->nombre, $registro->apellido, $registro->curso);
}
$conexion=null;
return $productos;
}
}
?>