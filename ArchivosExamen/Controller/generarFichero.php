<?php
require_once '../Model/Animal.php';

// Recibe la consulta que estaba activa en el formulario
$busqueda = isset($_REQUEST['busqueda']) ? trim($_REQUEST['busqueda']) : '';

$todosLosAnimales = Animal::getAnimales();
$animalesFiltrados = [];

foreach ($todosLosAnimales as $animal) {
    if ($busqueda === '' || mb_stripos($animal->getEspecie(), $busqueda) !== false) {
        $animalesFiltrados[] = $animal;
    }
}

// Cabeceras HTTP para transformar la respuesta PHP en una descarga de archivo de texto plano
header('Content-Type: text/plain; charset=utf-8');
header('Content-Disposition: attachment; filename="consulta_granja.txt"');

// Contenido interno del fichero con los datos de la consulta
echo "=========================================\r\n";
echo "       RESULTADOS DE LA CONSULTA         \r\n";
echo "       Filtro aplicado: " . ($busqueda !== '' ? $busqueda : 'Ninguno') . "\r\n";
echo "=========================================\r\n\r\n";

if (count($animalesFiltrados) > 0) {
            foreach ($animalesFiltrados as $animal) {
                $contenido .= "ID: " . $animal->getId() . 
                              " | Especie: " . $animal->getEspecie() . 
                              " | Cantidad: " . $animal->getCantidad() . 
                              " | Alimento: " . $animal->getComida() . "\r\n";
            }
        } else {
            $contenido .= "No se encontraron registros para esta consulta.\r\n";
        }

        // 2. Definimos la ruta física de almacenamiento (dentro de la misma carpeta Model)
        // __DIR__ apunta automáticamente a la carpeta actual donde está este archivo (Model/)
        $nombreArchivo = "consulta_granja.txt";
        $rutaCompleta = __DIR__ . DIRECTORY_SEPARATOR . $nombreArchivo;

        // 3. Escribimos el archivo en el disco del servidor
        file_put_contents($rutaCompleta, $contenido);

        // Retornamos un mensaje de éxito para que el controlador pueda usarlo
        echo "El fichero '" . $nombreArchivo . "' se ha generado correctamente dentro de la carpeta Model.";
header("Location: index.php?action=consultas&busqueda=" . urlencode($busqueda));
exit;