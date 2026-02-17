<?php
require_once 'Config.php';
require_once __DIR__ . '/Config.php';
class Reserva {
    private $id;
    private $id_sala;
    private $id_usuario;
    private $fecha;
    private $turno; // 'manana' o 'tarde'

    public function __construct($id = 0, $id_sala = 0, $id_usuario = 0, $fecha = "", $turno = "manana") {
        $this->id         = $id;
        $this->id_sala    = $id_sala;
        $this->id_usuario = $id_usuario;
        $this->fecha      = $fecha;
        $this->turno      = $turno;
    }

    // Comprueba si una sala ya está reservada para esa fecha y turno
    public static function estaOcupada($id_sala, $fecha, $turno) {
        $db   = Config::connectDB();
        $stmt = $db->prepare(
            "SELECT COUNT(*) FROM reservas 
             WHERE id_sala = :id_sala AND fecha = :fecha AND turno = :turno"
        );
        $stmt->execute([
            ':id_sala' => (int) $id_sala,
            ':fecha'   => $fecha,
            ':turno'   => $turno
        ]);
        return $stmt->fetchColumn() > 0;
    }

    public function insert() {
        if ($this->id_sala <= 0 || $this->id_usuario <= 0) {
            throw new Exception("Error: datos de reserva no válidos.");
        }

        // Bloquear si ya está ocupada
        if (self::estaOcupada($this->id_sala, $this->fecha, $this->turno)) {
            throw new Exception("Error: esa sala ya está reservada para ese turno y fecha.");
        }

        $db   = Config::connectDB();
        $stmt = $db->prepare(
            "INSERT INTO reservas (id_sala, id_usuario, fecha, turno) 
             VALUES (:id_sala, :id_usuario, :fecha, :turno)"
        );
        $stmt->execute([
            ':id_sala'    => $this->id_sala,
            ':id_usuario' => $this->id_usuario,
            ':fecha'      => $this->fecha,
            ':turno'      => $this->turno
        ]);
    }

    public static function getAllReservas() {
        $db     = Config::connectDB();
        $result = $db->query("SELECT * FROM reservas ORDER BY fecha, turno");
        $lista  = [];
        while ($reg = $result->fetchObject()) {
            $lista[] = new Reserva($reg->id, $reg->id_sala, $reg->id_usuario, $reg->fecha, $reg->turno);
        }
        return $lista;
    }

    public static function getReservasByUsuario($id_usuario) {
        $db   = Config::connectDB();
        $stmt = $db->prepare("SELECT * FROM reservas WHERE id_usuario = :id_usuario ORDER BY fecha, turno");
        $stmt->execute([':id_usuario' => (int) $id_usuario]);
        $lista = [];
        while ($reg = $stmt->fetchObject()) {
            $lista[] = new Reserva($reg->id, $reg->id_sala, $reg->id_usuario, $reg->fecha, $reg->turno);
        }
        return $lista;
    }

    public static function cancelar($id, $id_usuario) {
        $db   = Config::connectDB();
        // Solo puede cancelar su propia reserva (o admin cancela cualquiera)
        $stmt = $db->prepare("DELETE FROM reservas WHERE id = :id AND id_usuario = :id_usuario");
        $stmt->execute([':id' => (int) $id, ':id_usuario' => (int) $id_usuario]);
    }

    public static function cancelarAdmin($id) {
        $db   = Config::connectDB();
        $stmt = $db->prepare("DELETE FROM reservas WHERE id = :id");
        $stmt->execute([':id' => (int) $id]);
    }

    // Getters
    public function getId()          { return $this->id; }
    public function getIdSala()      { return $this->id_sala; }
    public function getIdUsuario()   { return $this->id_usuario; }
    public function getFecha()       { return $this->fecha; }
    public function getTurno()       { return $this->turno; }
}