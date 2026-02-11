<?php
// Ajusta esta URL a tu ruta real
$url = "http://localhost/EntornoServidor/Unidad12/Ejercicios_12_7/Ejercicio2/Servidor/api_cartas.php";

if (isset($_REQUEST['filtraCartas'])) {
    $parametros = "?numero=" . $_REQUEST['numero'];
    mostrarDatos($url, $parametros);
}

function mostrarEstado($codEstado, $mensaje) {
    echo "STATUS: " . $codEstado;
    echo "<br>" . $mensaje;
}

function mostrarDatos($url, $parametros) {
    // Petición al servidor usando el formato del maestro
    $data = @file_get_contents($url . $parametros);
    $respuesta = json_decode($data);
    
    // Extraer código de estado (ej: 200, 400)
    $codEstado = substr($http_response_header[0], 9, 3);
    $mensaje = substr($http_response_header[0], 13);

    if ($codEstado == 200) {
        echo "<h2>Mazo de Cartas Obtenido</h2>";
        echo "<table border='1'>
                <tr>
                    <th>Figura</th>
                    <th>Palo</th>
                </tr>";
        
        foreach ($respuesta as $carta) {
            echo "<tr>";
            echo "<td>" . $carta->figura . "</td>";
            echo "<td>" . $carta->palo . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        // Si hay error (ej: número > 40), muestra el mensaje del servidor
        mostrarEstado($codEstado, $mensaje);
        if (isset($respuesta->error)) {
            echo "<br>Detalle: " . $respuesta->error;
        }
    }
    echo "<br><a href='index.php'><h3>VOLVER</h3></a>";
}