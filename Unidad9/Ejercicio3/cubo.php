<?php
class Cubo {
    private $capacidad;
    private $contenido;

    public function __construct($cant, $cont) 
    {
        $this->capacidad = $cant;
        $this->contenido = $cont;
        
    }



   public function verterEn(Cubo $destino){
        $espacioLibre = $destino->capacidad - $destino->contenido;

        if ($this->contenido <= $espacioLibre) {
            $destino->contenido += $this->contenido;
            $this->contenido = 0;
        } else {
            $this->contenido -= $espacioLibre;
            $destino->contenido = $destino->capacidad;
        }
    }
}
?>