<?php
// Inicializar el arreglo de aspirantes
$aspirantes = [];

// Si hay datos serializados, deserializarlos
if (isset($_POST['aspirantes'])) {
    $aspirantes = unserialize(base64_decode($_POST['aspirantes']));
}

// Si se hace clic en "Añadir", agregar el nuevo aspirante
if (isset($_POST['añadir'])) {
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $anios = $_POST['anios'];
    $correo = $_POST['correo'];
    $aspirantes[] = ['nombre' => $nombre, 'edad' => $edad, 'anios' => $anios, 'correo' => $correo];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Aspirantes</title>
</head>
<body>
    <h1>Agregar Aspirantes</h1>
    <form method="post">
        <!-- Campo oculto para mantener el arreglo serializado -->
        <input type="hidden" name="aspirantes" value="<?php echo base64_encode(serialize($aspirantes)); ?>">
        
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br><br>
        
        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" required>
        <br><br>
        
        <label for="anios">Años de experiencia:</label>
        <input type="number" id="anios" name="anios" required>
        <br><br>
        
        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" required>
        <br><br>
        
        <input type="submit" name="añadir" value="Añadir">
    </form>
    
    <br><br>
    <form method="post" action="index.php">
        <input type="hidden" name="aspirantes" value="<?php echo base64_encode(serialize($aspirantes)); ?>">
        <input type="submit" value="Finalizar" name="finalizar">
    </form>
    <br><br>
</body>
</html>
