<?php
require_once 'Config.php'; // Tu clase de conexión

class Ticket {
    private $id;
    private $descripcion;
    private $archivo;
    private $estado;
    private $id_usuario;

    public function __construct($id=0, $desc="", $arch="", $est="pendiente", $user=0) {
        $this->id = $id;
        $this->descripcion = $desc;
        $this->archivo = $arch;
        $this->estado = $est;
        $this->id_usuario = $user;
    }

    // Guardar ticket con archivo
    public function insert() {
        $db = Config::connectDB();
        $sql = "INSERT INTO tickets (descripcion, archivo_adjunto, id_usuario) 
                VALUES ('$this->descripcion', '$this->archivo', $this->id_usuario)";
        $db->exec($sql);
    }

    // Cambiar estado (Proceso distinto)
    public static function actualizarEstado($id, $nuevoEstado) {
        $db = Config::connectDB();
        $db->exec("UPDATE tickets SET estado='$nuevoEstado' WHERE id=$id");
    }

    public static function getAllTickets() {
        $db = Config::connectDB();
        $result = $db->query("SELECT * FROM tickets");
        $lista = [];
        while($reg = $result->fetchObject()) {
            $lista[] = new Ticket($reg->id, $reg->descripcion, $reg->archivo_adjunto, $reg->estado, $reg->id_usuario);
        }
        return $lista;
    }

    // Getters
    public function getId() { return $this->id; }
    public function getDescripcion() { return $this->descripcion; }
    public function getEstado() { return $this->estado; }
    public function getArchivo() { return $this->archivo; }
    public function getId_usuario() { return $this->id_usuario; }
}