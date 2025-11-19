<?php
class Empleado {
    private $nombre;
    private $sueldo;

    public function __construct($nom, $sueldo) 
    {
        $this->nombre = $nom;
        $this->sueldo = $sueldo;
        
    }

    public function asigna($n, $s)
    {
        if($n == $this->nombre){
             $this->sueldo = $s ;
             return $this->sueldo;
        }
    }

    public function impuestos()
    {
        if($this->sueldo >= 3000){
            return $this->nombre. " debe pagar impuestos";
        }else {
            return $this->nombre. " no paga impuestos";
        }
    }

    /**
     * Get the value of sueldo
     */ 
    public function getSueldo()
    {
        return $this->sueldo;
    }

    /**
     * Set the value of sueldo
     *
     * @return  self
     */ 
    public function setSueldo($sueldo)
    {
        $this->sueldo = $sueldo;

        return $this;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }
}