<?php
// 1. Incluimos el modelo
require_once '../Model/WeatherModel.php';

// CONFIGURACIÓN: PEGA TU API KEY AQUÍ
$miApiKey = "PON_AQUI_TU_API_KEY";

// Variables iniciales para la vista
$resultado = null;
$error = null;

// 2. Lógica del Controlador
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Determinar qué ciudad eligió el usuario (texto o lista)
    $ciudadSeleccionada = !empty($_POST['ciudad_texto']) ? $_POST['ciudad_texto'] : $_POST['ciudad_select'];

    // Instanciar el modelo
    $modelo = new WeatherModel($miApiKey);
    
    // Pedir los datos al modelo
    $respuesta = $modelo->obtenerClima($ciudadSeleccionada);

    // Verificar si el modelo devolvió un error o un objeto de datos
    if (is_array($respuesta) && isset($respuesta['error'])) {
        $error = $respuesta['error'];
    } else {
        $resultado = $respuesta;
    }
}

// 3. Cargar la vista (le pasamos las variables $resultado y $error implícitamente)
require '../View/view.php';
?>