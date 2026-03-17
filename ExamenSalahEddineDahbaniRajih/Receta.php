<?php

class Receta
{
    // Atributos de instancia
    public $codigo;
    public $nombre;
    public $tipo;
    public $ingredientes;


    public function __construct( $codigo, $nombre,  $tipo, $ingredientes)
    {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->tipo = $tipo;
        $this->ingredientes = $ingredientes;
        
        // El constructor no actualiza las stats para evitar problemas al cargar del fichero.
    }

    // --- Getters ---
    public function getCodigo()
    {
        return $this->codigo;
    }
    public function setCodigo($codigo){
        $codigo = date("dmyHis") . strtoupper(substr($this->nombre,-1, 3)) ;
        return $this->codigo = $codigo;
    }

    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre($nombre){
        return $this->nombre = $nombre;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo) {
        return $this->tipo = $tipo;
        
    }

    public function getIngredientes()
    {
        return $this->ingredientes;
    }

     public function setIngredientes($ingredientes)
    {
        return $this->ingredientes = $ingredientes;
    }

    public function addIngredienteExtra($nuevo) {
    if (!empty($nuevo)) {
        $this->ingredientes[] = $nuevo;
    }
}

    
}