<?php
require_once 'Carro.php';

class Producto
{
  private $id;
  private $nombre;
  private $precio;
  private $urlImg;


  function __construct($id = "",$nombre = "", $precio= "",$urlImg = "")
  {
    $this->id = $id;
    $this->nombre = $nombre;
    $this->precio = $precio;
    $this->urlImg = $urlImg;
  }

  // Para obtener todos los productos
  public static function getProductos()
  {
    $conexion = Carrito::connectDB();
    $seleccion = "SELECT * FROM productos";
    $consulta = $conexion->query($seleccion);
    $Productos = [];
    while ($registro = $consulta->fetchObject()) {
      $Productos[] = new Producto($registro->id, $registro->nombre, $registro->precio, $registro->urlImg);
    }
    $conexion = null;
    return $Productos;
  }

   public static function getProductoById($id)
  {
    $conexion = Carrito::connectDB();
    $seleccion = "SELECT * FROM productos WHERE id=$id";
    $consulta = $conexion->query($seleccion);
    if ($consulta->rowCount() > 0) {
      $registro = $consulta->fetchObject();
      $producto = new Producto($registro->id, $registro->nombre, $registro->precio, $registro->urlImg);
      $conexion = null;
      return $producto;
    } else {
      $conexion = null;
      return false;
    }
  }

    public static function getProductoByNombre($nombre)
  {
    $conexion = Carrito::connectDB();
    $seleccion = "SELECT * FROM productos WHERE nombre='$nombre'";
    $consulta = $conexion->query($seleccion);
    if ($consulta->rowCount() > 0) {
      $registro = $consulta->fetchObject();
      $producto = new Producto($registro->id, $registro->nombre, $registro->precio, $registro->urlImg);
      $conexion = null;
      return $producto;
    } else {
      $conexion = null;
      return false;
    }
  }

  // método para validar el token y sumar la petición
public static function validarToken($token) {
    $conexion = Carrito::connectDB();
    $consulta = $conexion->prepare("SELECT nombre FROM clientes WHERE token = :token");
    $consulta->execute(['token' => $token]);
    
    if ($consulta->rowCount() > 0) {
        $update = $conexion->prepare("UPDATE clientes SET peticiones = peticiones + 1 WHERE token = :token");
        $update->execute(['token' => $token]);
        return true;
    }
    return false;
}
public static function getProductosFiltroNombre($nombre)
  {
    $conexion = Carrito::connectDB();
    $seleccion = "SELECT * FROM productos WHERE nombre LIKE '%$nombre%'";
    $consulta = $conexion->query($seleccion);
    $Productos = [];
    while ($registro = $consulta->fetchObject()) {
      $Productos[] = new Producto($registro->id, $registro->nombre, $registro->precio, $registro->urlImg);
    }
    $conexion = null;
    return $Productos;
  }
  
  public static function getProductosFiltroPrecio($min, $max)
  {
    $conexion = Carrito::connectDB();
    $seleccion = "SELECT * FROM productos WHERE precio>='$min' AND precio<='$max'";
    $consulta = $conexion->query($seleccion);
    $Productos = [];
    while ($registro = $consulta->fetchObject()) {
      $Productos[] = new Producto($registro->id, $registro->nombre, $registro->precio, $registro->urlImg);
    }
    $conexion = null;
    return $Productos;
  }
  
   // Para reponer productos 
  public function añadir()
  {
    $conexion = Carrito::connectDB();
    $reponer = "UPDATE productos SET stock='$this->stock' WHERE id='$this->id'";
    $conexion->exec($reponer);
    $conexion = null;
  }

  // Para crear productos 
  public function insert()
  {
    $conexion = Carrito::connectDB();
    $insercion = "INSERT INTO productos (nombre, precio, urlImg) VALUES ('$this->nombre','$this->precio','$this->urlImg')";
    $conexion->exec($insercion);
    $conexion = null;
  }

  // Para borrar productos 
  public function delete()
  {
    $conexion = Carrito::connectDB();
    $borrado = "DELETE FROM productos WHERE id='$this->id'";
    $conexion->exec($borrado);
    $conexion = null;
  }
 
  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    $this->id = $id;

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

  public function getUrlImg()
  {
    return $this->urlImg;
  }

  public function setUrlImg($urlImg)
  {
    $this->urlImg = $urlImg;

    return $this;
  }
}
