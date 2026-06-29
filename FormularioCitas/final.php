<?php
session_start();

// Leemos el teléfono del administrador
$archivo = 'telefono.txt';
$telefono = '';
if (file_exists($archivo)) {
    $telefono = file_get_contents($archivo);
}

// Si por alguna razón no hay teléfono o no hay respuestas de la sesión, ponemos datos por defecto para evitar errores
$comida = isset($_SESSION['cita_comida']) ? $_SESSION['cita_comida'] : 'Sorpresa';
$dia    = isset($_SESSION['cita_dia'])    ? $_SESSION['cita_dia']    : 'Pronto';
$hora   = isset($_SESSION['cita_hora'])   ? $_SESSION['cita_hora']   : 'Por confirmar';

// Creamos el texto del mensaje automatizado
$texto_mensaje = "¡Hola! ❤️ He completado la encuesta de nuestra cita:\n\n";
$texto_mensaje .= "✨ ¿Qué comeremos?: $comida\n";
$texto_mensaje .= "📅 ¿Qué día?: $dia\n";
$texto_mensaje .= "⏰ ¿A qué hora?: $hora\n\n";
$texto_mensaje .= "¡Tengo muchas ganas! 🥰";

// Codificamos el texto para que sea apto para una URL
$texto_url = urlencode($texto_mensaje);

// Construimos el enlace definitivo de WhatsApp
$enlace_whatsapp = "https://api.whatsapp.com/send?phone=" . $telefono . "&text=" . $texto_url;

// Opcional: Destruimos la sesión por si quieren volver a jugar desde el principio otra vez
session_destroy();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Cita Agendada! 💖</title>
    <style>
        body {
            margin: 0; font-family: sans-serif;
            background: linear-gradient(135deg, #ffe5ec, #ffc2d1);
            height: 100vh; display: flex; justify-content: center; align-items: center;
        }
        .contenedor {
            text-align: center; background: white; padding: 40px;
            border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            width: 90%; max-width: 450px;
        }
        h2 { color: #2a9d8f; }
        p { color: #555; line-height: 1.6; font-size: 16px; }
        .resumen {
            background-color: #f8f9fa; padding: 15px;
            border-radius: 10px; text-align: left;
            margin: 20px 0; border-left: 5px solid #ff4d6d;
            white-space: pre-line; font-size: 15px;
        }
        .btn-enviar {
            display: inline-block; padding: 15px 30px;
            background-color: #25d366; color: white; /* Color oficial de WhatsApp */
            text-decoration: none; font-weight: bold; font-size: 18px;
            border-radius: 50px; box-shadow: 0 4px 10px rgba(37,211,102,0.3);
            transition: transform 0.2s;
        }
        .btn-enviar:hover { transform: scale(1.05); background-color: #20ba5a; }
    </style>
</head>
<body>
<div class="contenedor">
    <div style="font-size: 50px;">🎉🥳</div>
    <h2>¡Trato hecho!</h2>
    <p>Ya tenemos todos los detalles listos. Haz clic en el botón de abajo para enviarme las respuestas finales por WhatsApp y confirmar la cita.</p>
    
    <div class="resumen"><?php echo htmlspecialchars($texto_mensaje); ?></div>
    
    <a href="<?php echo $enlace_whatsapp; ?>" class="btn-enviar">Confirmar en WhatsApp 💬</a>
</div>
</body>
</html>