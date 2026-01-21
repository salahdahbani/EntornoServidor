<?php
if (session_status() == PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['ultima'])) {
    $_SESSION['ultima']="Ninguna notra registrada";
    $_SESSION['fecha']=0;
}
   class Nota{
    private $titulo;
    private $texto;
    private $creacion;

    public static function getUltima(){
        return $_SESSION['ultima'];
    }
    public static function getFecha(){
        return $_SESSION['fecha'];
    }

    function __construct($titulo, $texto)
    {
        $this->titulo=$titulo;
        $this->texto=$texto;
        $this->creacion=time();
        $_SESSION['ultima']=$this->titulo;
        $_SESSION['fecha']=$this->creacion;
    }


    public function getTitulo()
    {
        return $this->titulo;
    }
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function getTexto()
    {
        return $this->texto;
    }
    public function setTexto($texto)
    {
        $this->texto = $texto;

    }
    public function getCreacion()
    {
        return $this->creacion;
    }
   }
?> 