<?php
if (isset($_REQUEST['consultar'])) {
    $apiKey = "5b9efae574bc202f3da4d89a39b1d3d2";
    $ciudad = urlencode($_REQUEST['ciudad']);
    
    // Construimos la URL de la API externa
    // units=metric es para Celsius, lang=es para español
$url = "https://api.openweathermap.org/data/2.5/weather?q=" . $ciudad . "&appid=" . $apiKey . "&units=metric&lang=es";    
    mostrarClima($url);
}

function mostrarClima($url) {
    // El @ evita que PHP lance un error feo si la ciudad no existe (404)
    $data = @file_get_contents($url);
    
    // En las APIs externas, el $http_response_header también se llena automáticamente
    $codEstado = substr($http_response_header[0], 9, 3);
    
    if ($codEstado == 200) {
        $respuesta = json_decode($data);
        
        echo "<h1>Clima en " . $respuesta->name . "</h1>";
        echo "<table border='1' style='margin:auto; background:white;'>";
        echo "<tr><th>Parámetro</th><th>Valor</th></tr>";
        
        // Investigando los parámetros de la API:
        echo "<tr><td>Temperatura</td><td>" . $respuesta->main->temp . "°C</td></tr>";
        echo "<tr><td>Sensación Térmica</td><td>" . $respuesta->main->feels_like . "°C</td></tr>";
        echo "<tr><td>Humedad</td><td>" . $respuesta->main->humidity . "%</td></tr>";
        echo "<tr><td>Descripción</td><td>" . $respuesta->weather[0]->description . "</td></tr>";
        echo "<tr><td>Viento</td><td>" . $respuesta->wind->speed . " m/s</td></tr>";
        
        echo "</table>";
    } else {
        echo "<h2>Error: Ciudad no encontrada (Código $codEstado)</h2>";
    }
    
    echo "<br><a href='index.php'>VOLVER</a>";
}