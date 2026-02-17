<?php
require_once 'Config.php';

class Usuario {
    private $id;
    private $nombre;
    private $rol;

    function __construct($id=0, $nombre="", $rol="") {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->rol = $rol;
    }

    public function getId() { return $this->id; }
    public function getNombre() { return $this->nombre; }
    public function getRol() { return $this->rol; }

public static function getUsuarios() {
        $conexion = Config::connectDB();
        $seleccion = "SELECT * FROM usuarios";
        $consulta = $conexion->query($seleccion);
        $usuarios = [];
        while ($registro = $consulta->fetchObject()) {
            $usuarios[] = new Usuario($registro->id, $registro->nombre, $registro->rol);
        }
        return $usuarios;
    }

public function insert() {
		$conexion = Config::connectDB();
		$insercion = "INSERT INTO usuarios VALUES (null, '$this->nombre', '$this->rol')";
		$conexion->exec($insercion);
	}

    public static function getUsuarioById($id) {
        $conexion = Config::connectDB();
        $seleccion = "SELECT * FROM usuarios WHERE id=$id";
        $consulta = $conexion->query($seleccion);
        if ($registro = $consulta->fetchObject()) {
            return new Usuario($registro->id, $registro->nombre, $registro->rol);
        }
        return false;
    }

    public static function getUsuarioByNombre($nombre) {
        $conexion = Config::connectDB();
        $seleccion = "SELECT * FROM usuarios WHERE nombre='$nombre'";
        $consulta = $conexion->query($seleccion);
        if ($registro = $consulta->fetchObject()) {
            return new Usuario($registro->id, $registro->nombre, $registro->rol);
        }
        return false;
    }
}