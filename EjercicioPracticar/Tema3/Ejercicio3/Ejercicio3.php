<?php
if(isset($_POST['Enviar'])){
   $color_fondo = $_POST['color_fondo'];
    $texto = $_POST['texto'];
    $color_texto = $_POST['color_texto'];
    $tamano_texto = $_POST['tamano_texto'];
    $fuente = $_POST['fuente'];
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Documento Personalizado</title>
        <style>
            body {
                background-color: $color_fondo;
                color: $color_texto;
                font-family: $fuente;
                font-size: {$tamano_texto}px;
            }
        </style>
    </head>
    <body>
        $texto
    </body>
    </html>";
    echo "<br><br><a href='Formulario.php' style='color: black; text-decoration: underline;'>Volver al formulario</a>";
} else {
    echo "No se recibieron datos del formulario.";
}
?>