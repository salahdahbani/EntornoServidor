<?php
require_once 'GranjaDB.php';
class Animal {
    private $id;
    private $especie;
    private $cantidad;
    private $comida;

    function __construct($id=0, $especie="", $cantidad=0, $comida="") {
        $this->id = $id;	
        $this->especie = $especie;
        $this->cantidad = $cantidad;
        $this->comida = $comida;
    }

    public function insert() {
        $conexion = GranjaDB::connectDB();
        $insercion = "INSERT INTO animal (especie, cantidad, comida) VALUES (\"".$this->especie."\", \"".$this->cantidad."\", \"".$this->comida."\")";
        $conexion->exec($insercion);
    }
    public function delete() {
        $conexion = GranjaDB::connectDB();
        $borrado = "DELETE FROM animal WHERE id=\"".$this->id."\"";
        $conexion->exec($borrado);
    }
    public function update() {
        $conexion = GranjaDB::connectDB();
        $actualiza = "UPDATE animal SET cantidad=\"".$this->cantidad."\", comida=\"".$this->comida."\" WHERE id=\"".$this->id."\"";
        $conexion->exec($actualiza);
    }
    
    public static function getAnimales() {
        $conexion = GranjaDB::connectDB();
        $seleccion = "SELECT id, especie, cantidad, comida FROM animal";
        $consulta = $conexion->query($seleccion);
        $animal = [];
        while ($registro = $consulta->fetchObject()) {
            $animal[] = new animal($registro->id, $registro->especie, $registro->cantidad, $registro->comida);
        }
        return $animal;
    }
   
    public static function getAnimalById($id) {
        $conexion = GranjaDB::connectDB();
        $seleccion = "SELECT id, especie, cantidad, comida FROM animal WHERE id=\"".$id."\"";
        $consulta = $conexion->query($seleccion);
        if ($consulta->rowCount()>0) {
            $registro = $consulta->fetchObject();
            $animal = new Animal($registro->id, $registro->especie, $registro->cantidad, $registro->comida);
            return $animal;
        } else {
            return false;
        }
        
    }
    
    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
        return $this;
    }
    public function getEspecie() {
        return $this->especie;
    }
    public function setEspecie($especie) {
        $this->especie = $especie;
        return $this;
    }
    public function getCantidad() {
        return $this->cantidad;
    }
    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
        return $this;
    }
    public function getComida() {
        return $this->comida;
    }
    public function setComida($comida) {
        $this->comida = $comida;
        return $this;
    }
}