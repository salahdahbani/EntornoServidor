<?php

class Factura {

    // Atributo de clase
    public static $IVA = 21;

    private $importeBase;
    private $fecha;
    private $estado; 
    private $productos; 

    public function __construct($fecha, $estado = "pendiente"){
        $this->fecha = $fecha;
        $this->estado = $estado;
        $this->productos = [];
        $this->importeBase = 0;
    }

    public function añadeProducto($nombre, $precio, $cantidad){
        $this->productos[] = [
            "nombre" => $nombre,
            "precio" => $precio,
            "cantidad" => $cantidad
        ];

        $this->importeBase += ($precio * $cantidad);
    }

  
    public function imprimeFactura(){
        echo "<h2>Factura</h2>";
        echo "Fecha: " . $this->fecha . "<br>";
        echo "Estado: " . $this->estado . "<br><br>";

        echo "<table border='1' cellpadding='5'>";
        echo "<tr><th>Producto</th><th>Precio</th><th>Cantidad</th><th>Total</th></tr>";

        foreach($this->productos as $p){
            echo "<tr>";
            echo "<td>".$p["nombre"]."</td>";
            echo "<td>".$p["precio"]." €</td>";
            echo "<td>".$p["cantidad"]."</td>";
            echo "<td>".($p["precio"] * $p["cantidad"])." €</td>";
            echo "</tr>";
        }

        echo "</table><br>";

        $iva = $this->importeBase * (self::$IVA / 100);
        $total = $this->importeBase + $iva;

        echo "Importe Base: " . $this->importeBase . " €<br>";
        echo "IVA (" . self::$IVA . "%): " . $iva . " €<br>";
        echo "<strong>Total a pagar: " . $total . " €</strong><br>";
    }

    // ------------------------
    //         GETTERS
    // ------------------------
    public function getImporteBase(){
        return $this->importeBase;
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function getEstado(){
        return $this->estado;
    }

    public function getProductos(){
        return $this->productos;
    }

    // ------------------------
    //         SETTERS
    // ------------------------
    public function setFecha($f){
        $this->fecha = $f;
    }

    public function setEstado($e){
        if($e === "pagada" || $e === "pendiente"){
            $this->estado = $e;
        }
    }
}
?>
