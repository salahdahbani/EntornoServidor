<?php

class Proyecto
{
    // Atributos de instancia
    public $codigo;
    public $descripcion;
    public $urgencia;
    public $desarrolladores;

    // Atributos ESTÁTICOS para las estadísticas de urgencia
    public static $stats = ['Crítica' => 0, 'Alta' => 0, 'Media' => 0, 'Baja' => 0];

    public function __construct(string $codigo, string $descripcion, string $urgencia, array $desarrolladores)
    {
        $this->codigo = $codigo;
        $this->descripcion = $descripcion;
        $this->urgencia = $urgencia;
        $this->desarrolladores = $desarrolladores;
        
        // El constructor no actualiza las stats para evitar problemas al cargar del fichero.
    }

    // --- Getters ---
    public function getCodigo(): string
    {
        return $this->codigo;
    }

    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    public function getUrgencia(): string
    {
        return $this->urgencia;
    }

    public function getDesarrolladores(): array
    {
        return $this->desarrolladores;
    }

    // --- Setter para modificar la prioridad/urgencia ---
    public function setUrgencia(string $nuevaUrgencia): void
    {
        $this->urgencia = $nuevaUrgencia;
    }

    // --- Métodos Estáticos ---
    public static function resetStats(): void
    {
        Proyecto::$stats = ['Crítica' => 0, 'Alta' => 0, 'Media' => 0, 'Baja' => 0];
    }
}