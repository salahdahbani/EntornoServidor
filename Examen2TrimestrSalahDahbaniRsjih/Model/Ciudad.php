<?php
require_once 'LogisticaDB.php';
class Ciudad {
	private $id;
	private $nombre;

	function __construct($id=0, $nombre="") {
		$this->id = $id;	
		$this->nombre = $nombre;
	}

	public function insert() {
		$conexion = LogisticaDB::connectDB();
		$insercion = "INSERT INTO ciudad VALUES (null, '$this->nombre')";
		$conexion->exec($insercion);
	}
	public function delete() {
		$conexion = LogisticaDB::connectDB();
		$borrado = "DELETE FROM ciudad WHERE id=$this->id";
		$conexion->exec($borrado);
	}
	public function update() {
		$conexion = LogisticaDB::connectDB();
		$actualiza = "UPDATE ciudad SET nombre='$this->nombre' WHERE id=$this->id";
		$conexion->exec($actualiza);
	}
	public static function getCiudades() {
		$conexion = LogisticaDB::connectDB();
		$seleccion = "SELECT * FROM ciudad ORDER BY nombre";
		$consulta = $conexion->query($seleccion);
		$ciudad = [];
		while ($registro = $consulta->fetchObject()) {
			$ciudad[] = new Ciudad($registro->id, $registro->nombre);
		}
		return $ciudad;
	}
	public static function getCiudadById($id) {
		$conexion = LogisticaDB::connectDB();
		$seleccion = "SELECT * FROM ciudad WHERE id=$id";
		$consulta = $conexion->query($seleccion);
		if ($registro = $consulta->fetchObject()) {
			return new Ciudad($registro->id, $registro->nombre);
		} else {
			return false;
		}		
	}

	public static function getCiudadByNombre($nombre) {
        $db   = LogisticaDB::connectDB();
        $stmt = $db->prepare("SELECT * FROM ciudad WHERE nombre = :nombre");
        $stmt->execute([':nombre' => $nombre]);
        $reg  = $stmt->fetchObject();
        if ($reg) {
            return new Ciudad($reg->id, $reg->nombre);
        }
        return null;
    }
	
	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;

		return $this;
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function setNombre($nombre){
		$this->nombre = $nombre;

		return $this;
	}
}
