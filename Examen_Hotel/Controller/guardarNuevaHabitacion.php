<?php
if (session_status() == PHP_SESSION_NONE) session_start();
require_once '../Model/Habitacion.php';

// Validamos los nombres de los inputs de tu formulario HTML
if (isset($_POST['numero']) && !empty($_POST['tipo']) && isset($_POST['precio']) && isset($_POST['capacidad'])) {
    
    $numero    = $_POST['numero'];
    $tipo_id   = (int)$_POST['tipo'];
    $precio    = (float)$_POST['precio'];
    $capacidad = (int)$_POST['capacidad'];
    
    // 🔥 SOLUCIÓN: Respetamos el orden exacto del __construct del modelo
    // Posición:         1º ($id), 2º ($numero), 3º ($tipo_id), 4º ($precio), 5º ($capacidad)
    $nuevaHabitacion = new Habitacion(0, $numero, $tipo_id, $precio, $capacidad);
    
    $nuevaHabitacion->insert();
    
    $_SESSION['ultima_accion'] = "Registrada nueva habitación (" . htmlspecialchars($numero) . ") con éxito.";
}

header('Location: index.php?action=listar');
exit;