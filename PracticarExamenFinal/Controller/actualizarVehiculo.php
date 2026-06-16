<?php
require_once '../Model/Vehiculo.php';

if (isset($_POST['id']) && isset($_POST['modelo']) && isset($_POST['categoria']) && isset($_POST['nuevo_estado'])) {
    
    // Recogemos el estado directamente del formulario (1 para disponible, 0 para alquilado)
    $disponible = intval($_POST['nuevo_estado']);
    
    // Instanciamos el objeto con los datos que han viajado de manera segura en el POST
    $vehiculo = new Vehiculo($_POST['id'], $_POST['modelo'], $_POST['categoria'], $disponible);
    
    // Ejecutamos el update en la Base de Datos
    $vehiculo->update();
}

// Redirección al controlador frontal
header('Location: index.php?action=listar');
exit;