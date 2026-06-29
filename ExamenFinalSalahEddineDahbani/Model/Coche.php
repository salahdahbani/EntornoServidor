<?php
require_once 'SurmotorDB.php';
class coche {
    private $id;
    private $modelo;
    private $unidades;
    private $concesionario;

    function __construct($id=0, $modelo="", $unidades=0, $concesionario="") {
        $this->id = $id;	
        $this->modelo = $modelo;
        $this->unidades = $unidades;
        $this->concesionario = $concesionario;
    }

    public function insert() {
        $conexion = SurmotorDB::connectDB();
        $insercion = "INSERT INTO coche (modelo, unidades, concesionario) VALUES (\"".$this->modelo."\", \"".$this->unidades."\", \"".$this->concesionario."\")";
        $conexion->exec($insercion);
    }
    public function actualizar() {
        $conexion = SurmotorDB::connectDB();
        $actualiza = "UPDATE coche SET unidades=\"".$this->unidades."\", concesionario=\"".$this->concesionario."\" WHERE modelo=\"".$this->modelo."\"";
     $conexion->exec($actualiza);
    
    }
    public function delete() {
        $conexion = SurmotorDB::connectDB();
        $borrado = "DELETE FROM coche WHERE id=\"".$this->id."\"";
        $conexion->exec($borrado);
    }
    public function update() {
        $conexion = SurmotorDB::connectDB();
        $actualiza = "UPDATE coche SET unidades=\"".$this->unidades."\", concesionario=\"".$this->concesionario."\" WHERE id=\"".$this->id."\"";
        $conexion->exec($actualiza);
    }
    public static function getCoches() {
        $conexion = SurmotorDB::connectDB();
        $seleccion = "SELECT id, modelo, unidades, concesionario FROM coche ORDER BY concesionario, modelo";
        $consulta = $conexion->query($seleccion);
        $coches = [];
        while ($registro = $consulta->fetchObject()) {
            $coches[] = new coche($registro->id, $registro->modelo, $registro->unidades, $registro->concesionario);
        }
        return $coches;
    }
    public static function getCocheById($id) {
        $conexion = SurmotorDB::connectDB();
        $seleccion = "SELECT id, modelo, unidades, concesionario FROM coche WHERE id=\"".$id."\"";
        $consulta = $conexion->query($seleccion);
        if ($registro = $consulta->fetchObject()) {
            $coche = new coche($registro->id, $registro->modelo, $registro->unidades, $registro->concesionario);
            return $coche;
        }
        return null;        
    }
    public static function getCocheByModelo($modelo) {
        $conexion = SurmotorDB::connectDB();
        $seleccion = "SELECT id, modelo, unidades, concesionario FROM coche WHERE modelo=\"".$modelo."\"";
        $consulta = $conexion->query($seleccion);
        if ($registro = $consulta->fetchObject()) {
            $coche = new coche($registro->id, $registro->modelo, $registro->unidades, $registro->concesionario);
            return $coche;
        }
        return null;        
    }
    
    public function getid() {
        return $this->id;
    }
    public function setid($id) {
        $this->id = $id;
        return $this;
    }
    public function getmodelo() {
        return $this->modelo;
    }
    public function setmodelo($modelo) {
        $this->modelo = $modelo;
        return $this;
    }
    public function getunidades() {
        return $this->unidades;
    }
    public function setunidades($unidades) {
        $this->unidades = $unidades;
        return $this;
    }
    public function getconcesionario() {
        return $this->concesionario;
    }
    public function setconcesionario($concesionario) {
        $this->concesionario = $concesionario;
        return $this;
    }
}