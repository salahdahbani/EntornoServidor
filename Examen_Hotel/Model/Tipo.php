<?php
require_once 'HotelDB.php';
class Tipo {
    private $id;
    private $nombre;
    
    function __construct($id=0, $nombre="") {
        $this->id = $id;	
        $this->nombre = $nombre;
    }

    public static function getTipos() {
        $conexion = HotelDB::connectDB();
        $seleccion = "SELECT id, nombre FROM tipo ORDER BY nombre";
        $consulta = $conexion->query($seleccion);
        $tipos = [];
        while ($registro = $consulta->fetchObject()) {
            $tipos[] = new Tipo($registro->id, $registro->nombre);
        }
        return $tipos;
    }
    
    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; return $this; }
    public function getNombre() { return $this->nombre; }
    public function setNombre($nombre) { $this->nombre = $nombre; return $this; }
}