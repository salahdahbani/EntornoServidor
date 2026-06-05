<?php


class producto
{
    // Atributos de instancia
    public $id;
    public $nombre;
    public $precioBase;
    public $fecha;


    public function __construct( $id, $nombre, $precioBase, $fecha)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->precioBase = $precioBase;
        $this->fecha = $fecha;

        // El constructor no actualiza las stats para evitar problemas al cargar del fichero.
    }

    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of precioBase
     */ 
    public function getPrecioBase()
    {
        return $this->precioBase;
    }

    /**
     * Set the value of precioBase
     *
     * @return  self
     */ 
    public function setPrecioBase($precioBase)
    {
        $this->precioBase = $precioBase;

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

    public function __toString()
    {
        return "ID: " . $this->id . " | Nombre: " . $this->nombre . " | Precio Base: " . $this->precioBase;
    }

    public function calcularPrecioFinal()
    {
        return $this->precioBase; // En la clase base, el precio final es igual al precio base.
    }

    /**
     * Get the value of fecha
     */ 
    public function getFecha()
    {
        return date("Y/m/d");
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */ 
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }
}