<?php
require_once 'HotelDB.php';
class Habitacion {
    private $id;
    private $numero;
    private $tipo_id;
    private $precio;
    private $capacidad;
    private $tipo;

    function __construct($id=0, $numero="", $tipo_id=0, $precio=0, $capacidad=0, $tipo="") {
        $this->id = $id;	
        $this->numero = $numero;
        $this->tipo_id = $tipo_id;
        $this->precio = $precio;
        $this->capacidad = $capacidad;
        $this->tipo = $tipo;
    }

    public function insert() {
        $conexion = HotelDB::connectDB();
        $insercion = "INSERT INTO habitacion (numero, tipo_id, precio, capacidad) VALUES (\"".$this->numero."\", \"".$this->tipo_id."\", \"".$this->precio."\", \"".$this->capacidad."\")";
        $conexion->exec($insercion);
    }
    
    public function delete() {
        $conexion = HotelDB::connectDB();
        $borrado = "DELETE FROM habitacion WHERE id=\"".$this->id."\"";
        $conexion->exec($borrado);
    }
    
    public function update() {
        $conexion = HotelDB::connectDB();
        $actualiza = "UPDATE habitacion SET precio=\"".$this->precio."\", capacidad=\"".$this->capacidad."\" WHERE id=\"".$this->id."\"";
        $conexion->exec($actualiza);
    }
    
    public static function getHabitaciones() {
        $conexion = HotelDB::connectDB();
        $seleccion = "SELECT h.id, h.numero, h.tipo_id, h.precio, h.capacidad, t.nombre as tipo FROM habitacion h JOIN tipo t ON h.tipo_id = t.id";
        $consulta = $conexion->query($seleccion);
        $habitaciones = [];
        while ($registro = $consulta->fetchObject()) {
            $habitaciones[] = new Habitacion($registro->id, $registro->numero, $registro->tipo_id, $registro->precio, $registro->capacidad, $registro->tipo);
        }
        return $habitaciones;
    }
   
    public static function getHabitacionById($id) {
        $conexion = HotelDB::connectDB();
        $seleccion = "SELECT id, numero, tipo_id, precio, capacidad FROM habitacion WHERE id=\"".$id."\"";
        $consulta = $conexion->query($seleccion);
        if ($consulta->rowCount()>0) {
            $registro = $consulta->fetchObject();
            $habitacion = new Habitacion($registro->id, $registro->numero, $registro->tipo_id, $registro->precio, $registro->capacidad);
            return $habitacion;
        } else {
            return false;
        }
    }
    
    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; return $this; }
    public function getNumero() { return $this->numero; }
    public function setNumero($numero) { $this->numero = $numero; return $this; }
    public function getTipoId() { return $this->tipo_id; }
    public function setTipoId($tipo_id) { $this->tipo_id = $tipo_id; return $this; }
    public function getPrecio() { return $this->precio; }
    public function setPrecio($precio) { $this->precio = $precio; return $this; }
    public function getCapacidad() { return $this->capacidad; }
    public function setCapacidad($capacidad) { $this->capacidad = $capacidad; return $this; }
    public function getTipo() { return $this->tipo; }
}