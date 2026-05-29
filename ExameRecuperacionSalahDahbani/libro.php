<?php

include 'login.php';

class libro 
{
// Atributos de instancia
    public $titulo;
    public $estado;
    public $fecha;
    public $nombre;

    // Atributos ESTÁTICOS para las estadísticas de urgencia
    public static $stats = ['prestado' => 0, 'libre' => 0,];

    public function __construct(string $titulo, string $estado, string $fecha, string $nombre)
    {
        $this->titulo = $titulo;
        $this->estado = $estado;
        $this->fecha = date("d/m/Y");
        $this->nombre = $nombre;
        
        // El constructor no actualiza las stats para evitar problemas al cargar del fichero.
    }

    // --- Getters ---
    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function getEstado(): string
    {
        return $this->estado;
    }

    public function getFecha(): string
    {
        return $this->fecha;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    // --- Setter para modificar el estado ---
    public function setEstado(string $nuevoEstado): void
    {
        $this->estado = $nuevoEstado;
    }

    public function setNombre(string $nuevoUsuario): void
    {
        $this->nombre = $nuevoUsuario;
    }

    // --- Métodos Estáticos ---
    public static function resetStats(): void
    {
        Proyecto::$stats = ['prestado' => 0, 'libre' => 0,];
    }

    public static function prestar(): void
    {
        $estado = "prestado";
    }

    public static function devolver(): void
    {
        $estado = "devuelto";
    }
    
}