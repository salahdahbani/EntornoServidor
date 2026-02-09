<?php
require_once 'CarritoDB.php';
class Producto {
    private $codigo;
    private $nombre;
    private $precio;
    private $imagen;
    private $stock;

    function __construct($codigo=0, $nombre="", $precio=0, $imagen="", $stock=0) {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->imagen = $imagen;
        $this->stock = $stock;
    }

    public function insert() {
        $conexion = CarritoBD::connectDB();
        $insercion = "INSERT INTO carrito (nombre, precio, stock) VALUES (\"".$this->nombre."\", \"".$this->precio."\", \"".$this->stock."\")";
        $conexion->exec($insercion);
    }
    public function delete() {
        $conexion = CarritoBD::connectDB();
        $borrado = "DELETE FROM carrito WHERE codigo=\"".$this->codigo."\"";
        $conexion->exec($borrado);
    }
    public function update() {
        $conexion = CarritoBD::connectDB();
        $actualiza = "UPDATE carrito SET nombre=\"".$this->nombre."\", precio=\"".$this->precio."\", imagen=\"".$this->imagen."\" WHERE codigo=\"".$this->codigo."\"";
        $conexion->exec($actualiza);
    }
    public static function getProductos() {
        $conexion = CarritoBD::connectDB();
        $seleccion = "SELECT codigo, nombre, precio, imagen, stock FROM carrito ORDER BY nombre";
        $consulta = $conexion->query($seleccion);
        $productos = [];
        while ($registro = $consulta->fetchObject()) {
            $productos[] = new Producto($registro->codigo, $registro->nombre, $registro->precio, $registro->imagen, $registro->stock);
        }
        return $productos;
    }

    public static function getProductosFiltroPrecio($min, $max) {
        $conexion = CarritoBD::connectDB();
        $seleccion = "SELECT codigo, nombre, precio, imagen, stock FROM carrito WHERE precio >= ".$min." AND precio <=".$max;
        $consulta = $conexion->query($seleccion);
        $productos = [];
        while ($registro = $consulta->fetchObject()) {
            $productos[] = new Producto($registro->codigo, $registro->nombre, $registro->precio, null, $registro->stock);
        }
        return $productos;
    }

    public static function getProductosFiltroNombre($cad) {
        $conexion = CarritoBD::connectDB();
        $seleccion = "SELECT codigo, nombre, precio, imagen, stock FROM carrito WHERE nombre LIKE '%$cad%'";
        $consulta = $conexion->query($seleccion);
        $productos = [];
        while ($registro = $consulta->fetchObject()) {
            $productos[] = new Producto($registro->codigo, $registro->nombre, $registro->precio, null, $registro->stock);
        }
        return $productos;
    }
    public static function getProductoById($id) {
        $conexion = CarritoBD::connectDB();
        $seleccion = "SELECT codigo, nombre, precio, imagen, stock FROM carrito WHERE codigo=\"".$id."\"";
        $consulta = $conexion->query($seleccion);
        $registro = $consulta->fetchObject();
        $producto = new Producto($registro->codigo, $registro->nombre, $registro->precio, $registro->imagen, $registro->stock);
        return $producto;
    }
    public static function getProductoByNombre($nombre) {
        $conexion = CarritoBD::connectDB();
        $seleccion = "SELECT codigo, nombre, precio, imagen, stock FROM carrito WHERE nombre LIKE \"".$nombre."\"";
        $consulta = $conexion->query($seleccion);
        if ($consulta->rowCount() > 0) {
            $registro = $consulta->fetchObject();
            $producto = new Producto($registro->codigo, $registro->nombre, $registro->precio, $registro->imagen, $registro->stock);
            return $producto;
        }else {
            return false;
        }
    }
    public function añade($cant) {
        $conexion = CarritoBD::connectDB();
        $cant+=$this->stock;
        $actualiza = "UPDATE carrito SET stock='$cant' WHERE codigo='$this->codigo'";
        $conexion->exec($actualiza);
    }
    public function vender($cant){
        $conexion = CarritoBD::connectDB();
        $stock=Producto::getProductoById($this->codigo)->getStock();
        $diferencia=$stock-$cant;
        if ($diferencia>=0) {
            $actualiza = "UPDATE carrito SET stock=\"".$diferencia."\" WHERE codigo=\"".$this->codigo."\"";
            $conexion->exec($actualiza);
        }
    }
    public function getCodigo()
    {
        return $this->codigo;
    }
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }
    public function getPrecio()
    {
        return $this->precio;
    }
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }
    public function getImagen()
    {
        return $this->imagen;
    }
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }
    public function getStock()
    {
        return $this->stock;
    }
}
