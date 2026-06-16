<?php
require_once 'Conexion.php';

class Categoria {
    private $id;
    private $nombre;

    public function __construct($id, $nombre = "") {
        $this->id = $id;
        $this->nombre = $nombre;
    }

    public function getId() { return $this->id; }
    public function getNombre() { return $this->nombre; }

    /**
     * Obtiene todas las categorías desde phpMyAdmin
     */
    public static function getCategorias() {
        $conexion = Conexion::conectar();
        $stmt = $conexion->query("SELECT id, nombre FROM categorias");
        
        $categorias = [];
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $categorias[] = new Categoria($fila['id'], $fila['nombre']);
        }
        return $categorias;
    }
}