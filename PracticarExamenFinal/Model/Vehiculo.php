<?php
require_once 'Conexion.php';

class Vehiculo {
    private $id;
    private $modelo;
    private $categoria;
    private $disponible; // 1 = Disponible, 0 = Alquilado

    public function __construct($id, $modelo = "", $categoria = "", $disponible = 1) {
        $this->id = $id;
        $this->modelo = $modelo;
        $this->categoria = $categoria;
        $this->disponible = $disponible;
    }

    // GETTERS Y SETTERS
    public function getId() { return $this->id; }
    public function getModelo() { return $this->modelo; }
    public function getCategoria() { return $this->categoria; }
    public function getDisponible() { return $this->disponible; }
    
    public function setDisponible($disponible) { $this->disponible = $disponible; }

    /**
     * Trae todos los vehículos de la base de datos
     */
    public static function getVehiculos() {
        $conexion = Conexion::conectar();
        $stmt = $conexion->query("SELECT id, modelo, categoria, disponible FROM vehiculos");
        
        $vehiculos = [];
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $vehiculos[] = new Vehiculo($fila['id'], $fila['modelo'], $fila['categoria'], $fila['disponible']);
        }
        return $vehiculos;
    }

    /**
     * Busca un vehículo por su ID en phpMyAdmin
     */
    public static function getVehiculoById($id) {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("SELECT id, modelo, categoria, disponible FROM vehiculos WHERE id = :id");
        $stmt->execute(['id' => $id]);
        
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($fila) {
            return new Vehiculo($fila['id'], $fila['modelo'], $fila['categoria'], $fila['disponible']);
        }
        return null;
    }

    /**
     * Actualiza el estado de disponibilidad (Alquilar/Devolver)
     */
    public function update() {
        $conexion = Conexion::conectar();
        // Solo actualizamos el campo disponible basado en el ID
        $stmt = $conexion->prepare("UPDATE vehiculos SET disponible = :disponible WHERE id = :id");
        $stmt->execute([
            'disponible' => $this->disponible,
            'id' => $this->id
        ]);
    }

    public function delete() {
        $conexion = Conexion::conectar();
        $borrado = "DELETE FROM vehiculos WHERE id=\"".$this->id."\"";
        $conexion->exec($borrado);
    }

    /**
     * Inserta un nuevo vehículo en la base de datos
     */
    public function insert() {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("INSERT INTO vehiculos (modelo, categoria, disponible) VALUES (:modelo, :categoria, :disponible)");
        $stmt->execute([
            'modelo' => $this->modelo,
            'categoria' => $this->categoria,
            'disponible' => 1 // Por defecto entra como disponible
        ]);
    }
}