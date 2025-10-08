

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tabla de Imágenes</title>
</head>
<body>

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
// Detecta qué imagen fue pulsada
$imagenSeleccionada = isset($_GET['imagen']) ? $_GET['imagen'] : 0;

// Define cada imagen individualmente
$img1 = ($imagenSeleccionada == 1) ? 'ImagenGato/Imagen_1.png' : 'ImagenGato/gris_1.jpg';
$img2 = ($imagenSeleccionada == 2) ? 'ImagenGato/Imagen_2.png' : 'ImagenGato/gris_2.jpg';
$img3 = ($imagenSeleccionada == 3) ? 'ImagenGato/Imagen_3.png' : 'ImagenGato/gris_3.jpg';
$img4 = ($imagenSeleccionada == 4) ? 'ImagenGato/Imagen_4.png' : 'ImagenGato/gris_4.jpg';
$img5 = ($imagenSeleccionada == 5) ? 'ImagenGato/Imagen_5.png' : 'ImagenGato/gris_5.jpg';
$img6 = ($imagenSeleccionada == 6) ? 'ImagenGato/Imagen_6.png' : 'ImagenGato/gris_6.jpg';
$img7 = ($imagenSeleccionada == 7) ? 'ImagenGato/Imagen_7.png' : 'ImagenGato/gris_7.jpg';
$img8 = ($imagenSeleccionada == 8) ? 'ImagenGato/Imagen_8.png' : 'ImagenGato/gris_8.jpg';
$img9 = ($imagenSeleccionada == 9) ? 'ImagenGato/Imagen_9.png' : 'ImagenGato/gris_9.jpg';
?>

<table border="1">
<tr>
    <td><a href="?imagen=1"><img src="<?php echo $img1; ?>" width="30" height="30"></a></td>
    <td><a href="?imagen=2"><img src="<?php echo $img2; ?>" width="30" height="30"></a></td>
    <td><a href="?imagen=3"><img src="<?php echo $img3; ?>" width="30" height="30"></a></td>
</tr>
<tr>
    <td><a href="?imagen=4"><img src="<?php echo $img4; ?>" width="30" height="30"></a></td>
    <td><a href="?imagen=5"><img src="<?php echo $img5; ?>" width="30" height="30"></a></td>
    <td><a href="?imagen=6"><img src="<?php echo $img6; ?>" width="30" height="30"></a></td>
</tr>
<tr>
    <td><a href="?imagen=7"><img src="<?php echo $img7; ?>" width="30" height="30"></a></td>
    <td><a href="?imagen=8"><img src="<?php echo $img8; ?>" width="30" height="30"></a></td>
    <td><a href="?imagen=9"><img src="<?php echo $img9; ?>" width="30" height="30"></a></td>
</tr>
</table>

<br><br>

<form method="post">
    <input type="text" name="respuesta" placeholder="¿Qué es?" required>
    <input type="hidden" name="intentos" value="<?php echo isset($_POST['intentos']) ? $_POST['intentos'] : 0; ?>">

    <button type="submit">Comprobar</button>
</form>

<?php
echo "Intentos:  $intentos ";
echo $mensaje;

?>

</body>
</html>
