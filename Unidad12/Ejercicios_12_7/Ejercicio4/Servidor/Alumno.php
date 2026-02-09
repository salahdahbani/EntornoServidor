<?php
require_once 'EscuelaDB.php';
require_once 'Alumno.php';
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

    // GETTERS
    public function getMatricula() { return $this->matricula; }
    public function getNombre() { return $this->nombre; }
    public function getApellido() { return $this->apellido; }
    public function getCurso() { return $this->curso; }

    public function insert() {
        $conexion = EscuelaBD::connectDB();
        $insercion = "INSERT INTO alumno (nombre, apellido, curso) VALUES ('$this->nombre','$this->apellido','$this->curso')";
        $conexion->exec($insercion);
    }

    public function update() {
        $conexion = EscuelaBD::connectDB();
        $actualiza = "UPDATE alumno SET curso='$this->curso' WHERE nombre='$this->nombre'";
        $conexion->exec($actualiza);
    }
    
    public function getAsignaturaMat() {
    $conexion = EscuelaBD::connectDB();
    // IMPORTANTE: Asegúrate de que los nombres de las columnas (codigo_asignatura, matricula) 
    // sean los mismos que tienes en tu tabla asignatura_alumno
    $seleccion = "SELECT a.codigo, a.nombre FROM asignatura a 
                  INNER JOIN asignatura_alumno aa ON a.codigo = aa.codigo_asignatura 
                  WHERE aa.matricula = '$this->matricula'";
    
    $consulta = $conexion->query($seleccion);
    $asignaturas = [];
    while ($registro = $consulta->fetchObject()) {
        $asignaturas[] = new Asignatura($registro->codigo, $registro->nombre);
    }
    return $asignaturas;
}
    public function delete() {
        $conexion = EscuelaBD::connectDB();
        $borrado = "DELETE FROM alumno WHERE nombre='$this->nombre'";
        $conexion->exec($borrado);
    }
    public static function getAlumnosFiltroCurso($grupo) {
        $conexion = EscuelaBD::connectDB();
        $seleccion = "SELECT * FROM alumno WHERE curso LIKE '%$grupo%'";
        $consulta = $conexion->query($seleccion);
        $res = [];
        while ($reg = $consulta->fetchObject()) {
            $res[] = new Alumno($reg->matricula, $reg->nombre, $reg->apellido, $reg->curso);
        }
        return $res;
    }

    public static function getAlumnosFiltroNombre($cad) {
        $conexion = EscuelaBD::connectDB();
        $seleccion = "SELECT * FROM alumno WHERE nombre LIKE '%$cad%'";
        $consulta = $conexion->query($seleccion);
        $res = [];
        while ($reg = $consulta->fetchObject()) {
            $res[] = new Alumno($reg->matricula, $reg->nombre, $reg->apellido, $reg->curso);
        }
        return $res;
    }

    public static function getAlumnooByNombre($nombre) {
        $conexion = EscuelaBD::connectDB();
        $seleccion = "SELECT * FROM alumno WHERE nombre = '$nombre'";
        $consulta = $conexion->query($seleccion);
        if ($consulta->rowCount() > 0) {
            $reg = $consulta->fetchObject();
            // ANTES DEVOLVÍA PRODUCTO, AHORA ALUMNO:
            return new Alumno($reg->matricula, $reg->nombre, $reg->apellido, $reg->curso);
        }
        return false;
    }
}