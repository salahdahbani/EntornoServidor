<?php
require_once 'FotografiasDB.php';
require_once 'Usuario.php';
require_once 'Foto.php';
class Like {
	private $id_foto;
	private $id_usuario;

	function __construct($id_foto=0, $id_usuario=0) {
		$this->id_foto = $id_foto;
		$this->id_usuario = $id_usuario;	
	}

	public function insert() {
		$conexion = FotografiasDB::connectDB();
		$insercion = "INSERT INTO likes (id_foto, id_usuario) VALUES ($this->id_foto, $this->id_usuario)";
		$conexion->exec($insercion);
	}
	public function delete() {
		$conexion = FotografiasDB::connectDB();
		$borrado = "DELETE FROM likes WHERE id_foto=$this->id_foto AND id_usuario=$this->id_usuario";
		$conexion->exec($borrado);
	}
	public static function getLikeById($id_foto,$id_usuario) {
		$conexion = FotografiasDB::connectDB();
		$seleccion = "SELECT * FROM likes WHERE id_foto=$id_foto AND id_usuario=$id_usuario";
		$consulta = $conexion->query($seleccion);
		if ($like=$consulta->fetchObject()) {
			return $like;
		} else {
			return false;
		}
		
	}
	public static function getFotoMasLikes (){
		$conexion = FotografiasDB::connectDB();
		$seleccion = "SELECT id_foto, count(id_usuario) FROM likes GROUP BY id_foto ORDER BY count(id_usuario) DESC";
		$consulta = $conexion->query($seleccion);
		if ($consulta->rowCount()>0) {
			$registro=$consulta->fetchObject();
			return Foto::getFotoById($registro->id_foto);
		}else{
			return false;
		}
	}
	public static function getLikesByFoto($id) {
		$conexion = FotografiasDB::connectDB();
		$seleccion = "SELECT count(*) as total FROM likes WHERE id_foto=$id";
		$consulta = $conexion->query($seleccion);
		$resultado=$consulta->fetchObject();
		return $resultado->total;
	}
	public static function getUsersByLikesFoto($id_foto) {
		$conexion = FotografiasDB::connectDB();
		$seleccion = "SELECT * FROM likes WHERE id_foto=$id_foto";
		$consulta = $conexion->query($seleccion);
		$usuarios=[];
		while ($registro=$consulta->fetchObject()) {
			$usuarios[]=Usuario::getUsuarioById($registro->id_usuario);
		}
		return $usuarios;
	}
	
}