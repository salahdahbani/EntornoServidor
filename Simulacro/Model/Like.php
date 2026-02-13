<?php
require_once 'FotografiasDB.php';
require_once 'Usuario.php';
require_once 'Foto.php';
class Like {
	public $id_foto;
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

	public static function getFotos() {
$conexion = FotografiasDB::connectDB();
$seleccion = "SELECT * FROM likes";
$consulta = $conexion->query($seleccion);
$fotos = [];
while ($registro = $consulta->fetchObject()) {
$fotos[] = new Like($registro->id_foto, $registro->id_usuario);
}
$conexion=null;
return $fotos;
}
public static function getLike() {
$conexion = FotografiasDB::connectDB();
$seleccion = "SELECT id_foto, id_usuario FROM likes";
$consulta = $conexion->query($seleccion);
$fotos = [];
while ($registro = $consulta->fetchObject()) {
$fotos[] = new Like($registro->id_foto, $registro->id_usuario);
}
$conexion=null;
return $fotos;
}
public static function getLikeById($id_foto, $id_usuario) {
$conexion = FotografiasDB::connectDB();
$seleccion = "SELECT * FROM likes WHERE id_foto='$id_foto' AND id_usuario='$id_usuario'";
$consulta = $conexion->query($seleccion);
if ($consulta->rowCount() > 0) {
$registro = $consulta->fetchObject();
return new Like($registro->id_foto, $registro->id_usuario);
}
$conexion=null;
return false;
}

public static function borrarLike($id_usuario, $id_foto) {
$conexion = FotografiasDB::connectDB();
$borrado = "DELETE FROM likes WHERE id_usuario='$id_usuario' AND id_foto='$id_foto'";
$conexion->exec($borrado);
}

public static function getLikeByUsuario($id_usuario) {
$conexion = FotografiasDB::connectDB();
$seleccion = "SELECT * FROM likes WHERE id_usuario='$id_usuario'";
$consulta = $conexion->query($seleccion);
$fotos = [];
while ($registro = $consulta->fetchObject()) {
$fotos[] = new Like($registro->id_foto, $registro->id_usuario);
}
$conexion=null;
return $fotos;
}

public static function countLikesByFoto($id_foto) {
$conexion = FotografiasDB::connectDB();
$seleccion = "SELECT COUNT(*) AS total FROM likes WHERE id_foto='$id_foto'";
$consulta = $conexion->query($seleccion);
$registro = $consulta->fetchObject();
return $registro->total;
}

public static function getUsuarioFotos($id_foto) {
$conexion = FotografiasDB::connectDB();
$seleccion = "SELECT * FROM usuarios WHERE id IN (SELECT id_usuario FROM likes WHERE id_foto='$id_foto')";
$consulta = $conexion->query($seleccion);
$fotos = [];
while ($registro = $consulta->fetchObject()) {
$fotos[] = new Usuario($registro->id, $registro->nombre);
}
$conexion=null;
return $fotos;
}
}