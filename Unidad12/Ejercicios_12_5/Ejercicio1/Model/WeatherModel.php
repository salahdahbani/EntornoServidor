<?php
class WeatherModel {
    private $apiKey;

    public function __construct($key) {
        $this->apiKey = $key;
    }

    public function obtenerClima($ciudad) {
        // Validación básica
        if (empty($ciudad)) {
            return ["error" => "Por favor, introduce o selecciona una ciudad."];
        }

        // Preparamos la URL (igual que antes)
        $url = "http://api.openweathermap.org/data/2.5/weather?q=" . urlencode($ciudad) . "&units=metric&lang=es&appid=" . $this->apiKey;

        // Llamada a la API
        $contenido = @file_get_contents($url);

        if ($contenido === FALSE) {
            return ["error" => "No se pudo conectar o la ciudad no existe."];
        }

        $datos = json_decode($contenido);

        // Verificamos si la API devolvió un código 200 (OK)
        if ($datos->cod != 200) {
            return ["error" => "Error de la API: " . $datos->message];
        }

        return $datos;
    }
}
?>