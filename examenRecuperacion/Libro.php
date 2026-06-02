<?php

class Libro {
    public $titulo;
    public $estado;
    public $nombre;
    public $fecha;

    function __construct($t, $e, $n, $f) {
        $this->titulo = $t;
        $this->estado = $e;
        $this->nombre = $n;
        $this->fecha = $f;
    }

    function prestar($usuario) {
        $this->estado = "prestado";
        $this->nombre = $usuario;
        $this->fecha = date("Y-m-d");
    }

    function devolver() {
        $this->estado = "libre";
        $this->nombre = "";
        $this->fecha = "";
    }
}
?>