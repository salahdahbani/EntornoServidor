<?php

class Incidencia
{
    // Atributos de instancia
    public $matricula;
    public $descripcion;
    public $prioridad;
    public $estado = "ABIERTO";

    private static $conteoPrioridad = [
        'URGENTE' => 0,
        'NORMAL' => 0,
        'BAJA' => 0
    ];

    public static $stats = ['abierto' => 0, 'En proceso' => 0, 'Resuelta' => 0];

    public function __construct( $matricula, $descripcion, $prioridad)
    {
        $this->matricula = $matricula;
        $this->descripcion = $descripcion;
        $this->prioridad = $prioridad;
        $this->estado = "ABIERTO";

        // El constructor no actualiza las stats para evitar problemas al cargar del fichero.
    }

    // --- Getters ---
    public function getMatricula()
    {
        return $this->matricula;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getPrioridad()
    {
        return $this->prioridad;
    }

    public function getEstado()
    {
        return $this->estado;
    }

     public function resolver()
    {
        return $this->estado = "RESUELTA";
    }

        public function setPrioridad(string $nuevaPrioridad): void
        {
            $this->prioridad = $nuevaPrioridad;
        }

    public function setEstado(string $nuevoEstado): void
    {
        $this->estado = $nuevoEstado;
    }
    public static function resetPrioridad(): void
    {
        Incidencia::$conteoPrioridad = ['URGENTE' => 0,'NORMAL' => 0,'BAJA' => 0];
    }

}
