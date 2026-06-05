<?php
include 'producto.php';

class ProductoImportado extends producto
{
    public $tasaAduana;

    public function __construct($id, $nombre, $precioBase, $fecha, $tasaAduana)
    {
        parent::__construct($id, $nombre, $precioBase, $fecha);
        $this->tasaAduana = $tasaAduana;
    }

    public function calcularPrecioFinal()
    {
        return $this->precioBase + ($this->precioBase * $this->tasaAduana);
    }
}