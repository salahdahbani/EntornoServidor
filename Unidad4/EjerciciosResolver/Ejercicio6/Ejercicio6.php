<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tabla de Imágenes</title>
</head>
<body>

<h2>Tabla de imágenes</h2>
<?php
$mensaje = '';
$respuestaCorrecta = 'gato';
$intentos = isset($_POST['intentos']) ? intval($_POST['intentos']) : 0;

if (isset($_POST['respuesta'])) { 
    $intentos++;
    $respuesta = strtolower(trim($_POST['respuesta']));
    if ($respuesta === $respuestaCorrecta) {
        $mensaje = "<img src='ImagenGato/gato.jpg' width='300' height='300'>";
    } else {
        $mensaje = "No es la respuesta correcta.";
    }
}

$imagenSeleccionada = isset($_GET['imagen']) ? intval($_GET['imagen']) : 0;
?>


<table border="1">
<?php
$contador = 1; 

for ($fila = 0; $fila < 3; $fila++) {
    echo "<tr>";
    for ($col = 0; $col < 3; $col++) {
        echo "<td>";
        $imagen = ($contador == $imagenSeleccionada) ? "ImagenGato/Imagen_$contador.png" : "ImagenGato/gris_$contador.jpg";
        echo "<a href='?imagen=$contador'><img src='$imagen' width='30' height='30'></a>";
        echo "</td>";
        $contador++;
    }
    echo "</tr>";
}
?>
</table>

<br><br>

<form method="post">
    <input type="text" name="respuesta" placeholder="¿Qué es?" required>
    <input type="hidden" name="intentos" value="<?php echo $intentos; ?>">
    <button type="submit">Comprobar</button>
</form>

<?php
echo "<p>Intentos: $intentos</p>";
echo $mensaje;
?>

</body>
</html>
