<?php
require_once 'Config.php';

class Sala {
    private $id;
    private $nombre;
    private $capacidad;

    public function __construct($id = 0, $nombre = "", $capacidad = 0) {
        $this->id        = $id;
        $this->nombre    = $nombre;
        $this->capacidad = $capacidad;
    }

    public static function getAllSalas() {
        $db     = Config::connectDB();
        $result = $db->query("SELECT * FROM salas ORDER BY nombre");
        $lista  = [];
        while ($reg = $result->fetchObject()) {
            $lista[] = new Sala($reg->id, $reg->nombre, $reg->capacidad);
        }
        return $lista;
    }

    public static function getSalaById($id) {
        $db   = Config::connectDB();
        $stmt = $db->prepare("SELECT * FROM salas WHERE id = :id");
        $stmt->execute([':id' => (int) $id]);
        $reg  = $stmt->fetchObject();
        if ($reg) {
            return new Sala($reg->id, $reg->nombre, $reg->capacidad);
        }
        return null;
    }

    // Getters
    public function getId()        { return $this->id; }
    public function getNombre()    { return $this->nombre; }
    public function getCapacidad() { return $this->capacidad; }
}