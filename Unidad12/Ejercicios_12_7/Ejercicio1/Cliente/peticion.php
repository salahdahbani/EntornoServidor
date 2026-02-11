<?php
// Carpeta: Unidad12/Ejercicios_12_7/Ejercicio1/Cliente/peticion.php

// RUTA CORREGIDA según tu estructura de carpetas
$url = "http://localhost/EntornoServidor/Unidad12/Ejercicios_12_7/Ejercicio1/Servidor/api_monedas.php";

if (isset($_REQUEST['filtraPrecio'])) {
    $cantidad = $_REQUEST['cantidad'];
    $moneda = $_REQUEST['moneda'];
    
    $parametros = "?cantidad=" . $cantidad . "&moneda=" . $moneda;
    mostrarDatosMoneda($url, $parametros);
}

function mostrarEstado($codEstado, $mensaje) {
    echo "<h3>STATUS: $codEstado</h3>";
    echo "<p>Mensaje: $mensaje</p>";
}

function mostrarDatosMoneda($url, $parametros) {
    // El @ evita que PHP lance un Warning si la URL falla, lo manejamos con el status
    $data = @file_get_contents($url . $parametros);
    
    // Capturamos el código de estado HTTP
    $codEstado = substr($http_response_header[0], 9, 3);
    $mensaje = substr($http_response_header[0], 13);

    if ($codEstado == 200) {
        $respuesta = json_decode($data);
        echo "<h2>Resultado de la Conversión</h2>";
        echo "<p>El valor convertido es: <strong>" . $respuesta->resultado . " " . $respuesta->simbolo . "</strong></p>";
    } else {
        mostrarEstado($codEstado, $mensaje);
    }
    
    echo "<hr><a href='index.php'>Volver al formulario</a>";
}