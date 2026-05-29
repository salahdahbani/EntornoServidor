<?php
require_once 'LogisticaDB.php';
require_once 'Ciudad.php';
require_once __DIR__ . '/LogisticaDB.php';
class Transporte {
	private $id;
	private $origen;
	private $destino;
	private $fecha;
	private $empresa;

	function __construct($id=0, $origen='', $destino='', $fecha='', $empresa='') {
		$this->id = $id;
		$this->origen = $origen;
		$this->destino = $destino;
		$this->fecha = $fecha;
		$this->empresa = $empresa;
	}

	public function insert() {
		$db   = LogisticaDB::connectDB();
        $stmt = $db->prepare(
            "INSERT INTO transporte (origen, destino, fecha, empresa) 
             VALUES (:origen, :destino, :fecha, :empresa)"
        );
        $stmt->execute([
            ':origen'    => $this->origen,
            ':destino' => $this->destino,
			':fecha'      => $this->fecha,
            ':empresa'      => $this->empresa
            
        ]);
	}
	public function delete() {
		$conexion = LogisticaDB::connectDB();
		$borrado = "DELETE FROM transporte WHERE id=$this->id";
		$conexion->exec($borrado);
	}
	public function update() {
		$conexion = LogisticaDB::connectDB();
		$actualiza = "UPDATE transporte SET origen=$this->origen, destino=$this->destino, fecha='$this->fecha', empresa='$this->empresa' WHERE id=$this->id";
		$conexion->exec($actualiza);
	}
	public static function getTransportes() {
		$conexion = LogisticaDB::connectDB();
		$seleccion = "SELECT * FROM transporte ORDER BY fecha DESC";
		$consulta = $conexion->query($seleccion);
		$transportes = [];
		while ($registro=$consulta->fetchObject()) {
			$transportes[]= new Transporte($registro->id, $registro->origen, $registro->destino, $registro->fecha, $registro->empresa);
		}
		return $transportes;
	}
	public static function getTransporteById($id) {
		$conexion = LogisticaDB::connectDB();
		$seleccion = "SELECT * FROM transporte WHERE id=$id";
		$consulta = $conexion->query($seleccion);
		if ($registro=$consulta->fetchObject()) {
			return new Transporte($registro->id, $registro->origen, $registro->destino, $registro->fecha, $registro->empresa);
		} else {
			return false;
		}	
	}

	public function updateFecha() {
        $db = LogisticaDB::connectDB();
        $stmt = $db->prepare("UPDATE transporte SET fecha = ? WHERE id = ?");
        $stmt->execute([$this->fecha, $this->id]);
    }

<<<<<<< HEAD
// 	public function getCiudadId() {
// $conexion = EscuelaBD::connectDB();
// $seleccion = "SELECT * FROM ciudad JOIN transporte ON ciudad.id = asignatura_alumno.codigo_asignatura WHERE asignatura_alumno.matricula='$this->matricula'";
// $consulta = $conexion->query($seleccion);
// $asignaturas = [];
// while ($registro = $consulta->fetchObject()) {
// $asignaturas[] = new Asignatura($registro->codigo, $registro->nombre);
// }
// $conexion=null;
// return $asignaturas;
// }
=======
public static function getTransporteFiltroNombre($cad) {
        $conexion = LogisticaDB::connectDB();
        $seleccion = "SELECT id, origen, destino, fecha, empresa FROM transporte WHERE empresa LIKE '%$cad%'";
        $consulta = $conexion->query($seleccion);
        $transportes = [];
        while ($registro = $consulta->fetchObject()) {
            $transportes[] = new Transporte($registro->id, $registro->origen, $registro->destino, $registro->fecha, $registro->empresa);
        }
        return $transportes;
    }
>>>>>>> 707a7ae7bef1b796aa734c9b85d8b190f3e971c3
	
	public function getId() {
		return $this->id;
	}
	public function getOrigen() {
		return $this->origen;
	}
	public function getDestino() {
		return $this->destino;
	}
	public function getFecha() {
		return $this->fecha;
	}
	public function getEmpresa() {
		return $this->empresa;
	}
	public function setOrigen($origen) {
		$this->origen = $origen;
	}
	public function setDestino($destino) {
		$this->destino = $destino;
	}
	public function setFecha($fecha) {
		$this->fecha = $fecha;
	}
	public function setEmpresa($empresa) {
		$this->empresa = $empresa;
	}
}