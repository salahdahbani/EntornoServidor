<?php
require_once '../Model/Vehiculo.php';

// Recibe la consulta que estaba activa en el formulario
$busqueda = isset($_REQUEST['busqueda']) ? trim($_REQUEST['busqueda']) : '';

$todosLosVehiculos = Vehiculo::getVehiculos();
$vehiculosFiltrados = [];

foreach ($todosLosVehiculos as $vehiculo) {
    if ($busqueda === '' || mb_stripos($vehiculo->getModelo(), $busqueda) !== false) {
        $vehiculosFiltrados[] = $vehiculo;
    }
}

$nombreFicheroPost = (!empty($_POST['fichero'])) ? trim($_POST['fichero']) : 'consulta';
$nombreArchivo = $nombreFicheroPost . ".csv";
$rutaCompleta  = "../Model/" . $nombreArchivo; 

// Cabeceras HTTP para transformar la respuesta PHP en una descarga de archivo de texto plano
header('Content-Type: text/plain; charset=utf-8');
header('Content-Disposition: attachment; filename= "' . $nombreArchivo . '";');

// Contenido interno del fichero con los datos de la consulta
echo "=========================================\r\n";
echo "       RESULTADOS DE LA CONSULTA         \r\n";
echo "       Filtro aplicado: " . ($busqueda !== '' ? $busqueda : 'Ninguno') . "\r\n";
echo "=========================================\r\n\r\n";

if (count($vehiculosFiltrados) > 0) {
    foreach ($vehiculosFiltrados as $vehiculo) {
        // Simplificamos la lógica del estado con un operador ternario para evitar código duplicado
        $estado = ($vehiculo->getDisponible() == 1) ? "Disponible" : "Alquilado";
        
        $contenido .= "ID: " . $vehiculo->getId() . 
                      " | Modelo: " . $vehiculo->getModelo() . 
                      " | Categoria: " . $vehiculo->getCategoria() . 
                      " | Estado: " . $estado . "\r\n";
    }
} else {
    $contenido .= "No se encontraron registros para esta consulta.\r\n";
}

        // 2. Definimos la ruta física de almacenamiento (dentro de la misma carpeta Model)
        // __DIR__ apunta automáticamente a la carpeta actual donde está este archivo (Model/)
        
        $nombreFicheroPost =isset($_POST['fichero']) ? trim($_POST['fichero']) : 'consulta';
        $nombreArchivo = $nombreFicheroPost . ".txt";
        // $rutaCompleta = __DIR__ . DIRECTORY_SEPARATOR . $nombreArchivo;

        // 3. Escribimos el archivo en el disco del servidor
        file_put_contents($rutaCompleta, $contenido);

        // Retornamos un mensaje de éxito para que el controlador pueda usarlo
        echo "El fichero '" . $nombreArchivo . "' se ha generado correctamente dentro de la carpeta Model.";
header("Location: index.php?action=consultas&busqueda=" . urlencode($busqueda));
exit;