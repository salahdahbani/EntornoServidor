<?php
class Menu{
    private $titulo=[];
    private $enlace=[];

    

    public function añadirElemento($tit, $en)
    {
        $this->titulo[] = $tit;
        $this->enlace[] = $en;
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