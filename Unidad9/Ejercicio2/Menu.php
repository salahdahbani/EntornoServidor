<?php
class Menu{
    private $titulo;
    private $enlace;
<<<<<<< HEAD
=======

    public function __construct()
    {
        $this->titulo=[];
        $this->enlace=[];
    }
>>>>>>> 80591ae (Trabajo local: cambios en Unidad9/Ejercicio2 (respaldo))

    public function __construct()
    {
        $this->titulo = [];
        $this->enlace = [];
    }


    public function aniadirElemento($titulo, $enlace)
    {
        $this->titulo[] = $titulo;
        $this->enlace[] = $enlace;
    }

    public function horizontal()
    {
        $menu = "<div>";

        for ($i = 0; $i < count($this->titulo); $i++) {
            $menu .= "<a href='".$this->enlace[$i]."'>".$this->titulo[$i]."</a> | ";
        }

        return $menu."</div>";
    }

    public function vertical()
    {
        $menu = "<div>";

        for ($i = 0; $i < count($this->titulo); $i++) {
            $menu .= "<a href='".$this->enlace[$i]."'>".$this->titulo[$i]."</a><br>";
        }

        return $menu."</div>";
    }
}
?>
