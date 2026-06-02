<?php
require_once 'GranjaDB.php';
class Especie {
    private $id;
    private $nombre;
    
    function __construct($id=0, $nombre="") {
        $this->id = $id;	
        $this->nombre = $nombre;
    }

    public static function getEspecies() {
        $conexion = GranjaDB::connectDB();
        $seleccion = "SELECT id, nombre FROM especie ORDER BY nombre";
        $consulta = $conexion->query($seleccion);
        $especies = [];
        while ($registro = $consulta->fetchObject()) {
            $especies[] = new Especie($registro->id, $registro->nombre);
        }
        return $especies;
    }
    

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     *
     * @return self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }
}