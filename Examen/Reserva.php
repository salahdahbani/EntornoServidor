<?php
class Reserva {
    public $usuario;
    public $fechaHora;
    public $sala;
    public $estado;

    private static $totalPendientes = 0;

    public function __construct($usuario, $fechaHora, $sala) {
        $this->usuario = $usuario;
        $this->fechaHora = $fechaHora;
        $this->sala = $sala;
        $this->estado = 'PENDIENTE';

        Reserva::$totalPendientes++;
    }

    public function getFecha() {
        return date('d/m/Y', $this->fechaHora);
    }

    public function getHora() {
        return date('H:i', $this->fechaHora);
    }

    public function confirmar() {
        $this->estado = 'CONFIRMADA';
        Reserva::$totalPendientes--;
        return "ok";
    }

    public function anular() {
        if (time() < $this->fechaHora - 86400) {
            $this->estado = 'ANULADA';
            Reserva::$totalPendientes--;
            return "ok";
        }
        return "error";
    }

    public static function getTotalPendientes() {
        return Reserva::$totalPendientes;
    }

    public static function setTotalPendientes($valor) {
        Reserva::$totalPendientes = $valor;
    }
}
?>