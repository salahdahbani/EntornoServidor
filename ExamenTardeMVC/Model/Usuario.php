<?php
require_once 'Config.php';

class Usuario {
    private $id;
    private $nombre;
    private $password;
    private $rol;

    public function __construct($id = 0, $nombre = "", $password = "", $rol = "usuario") {
        $this->id       = $id;
        $this->nombre   = $nombre;
        $this->password = $password;
        $this->rol      = $rol;
    }

public function insert() {
    $conexion = Config::connectDB();
    // Especificamos las columnas para evitar errores con el ID autoincremental
    $insercion = "INSERT INTO usuarios (nombre, password, rol) 
                  VALUES ('$this->nombre', '$this->password', '$this->rol')";
    $conexion->exec($insercion);
}

    public static function getUsuarioByNombre($nombre) {
        $db   = Config::connectDB();
        $stmt = $db->prepare("SELECT * FROM usuarios WHERE nombre = :nombre");
        $stmt->execute([':nombre' => $nombre]);
        $reg  = $stmt->fetchObject();
        if ($reg) {
            return new Usuario($reg->id, $reg->nombre, $reg->password, $reg->rol);
        }
        return null;
    }

    public static function getUsuarioById($id) {
        $db   = Config::connectDB();
        $stmt = $db->prepare("SELECT * FROM usuarios WHERE id = :id");
        $stmt->execute([':id' => (int) $id]);
        $reg  = $stmt->fetchObject();
        if ($reg) {
            return new Usuario($reg->id, $reg->nombre, $reg->password, $reg->rol);
        }
        return null;
    }

    // Getters
    public function getId()       { return $this->id; }
    public function getNombre()   { return $this->nombre; }
    public function getPassword() { return $this->password; }
    public function getRol()      { return $this->rol; }
}