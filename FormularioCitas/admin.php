<?php
// Nombre del archivo donde se guardará el número
$archivo = 'telefono.txt';
$mensaje = '';

// Si el administrador envía el formulario con el nuevo número
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['telefono'])) {
    // Limpiamos el número para quitar espacios (debe incluir el código de país sin el "+", ej: 34600112233)
    $telefono = preg_replace('/\s+/', '', $_POST['telefono']);
    
    if (!empty($telefono)) {
        // Guardamos el número en el archivo (sobrescribe lo anterior)
        file_put_contents($archivo, $telefono);
        $mensaje = '<div class="alerta exito">¡Número guardado correctamente!</div>';
    } else {
        $mensaje = '<div class="alerta error">Por favor, introduce un número válido.</div>';
    }
}

// Leemos el número actual guardado para mostrarlo en el formulario
$telefono_actual = '';
if (file_exists($archivo)) {
    $telefono_actual = file_get_contents($archivo);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Configuración de Cita</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f7f9fc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .contenedor-admin {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 400px;
        }
        h2 {
            color: #333;
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
        }
        p {
            color: #666;
            font-size: 14px;
            line-height: 1.5;
        }
        .grupo-formulario {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #444;
            font-weight: 600;
        }
        input[type="text"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #ff4d6d;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.2s;
        }
        button:hover {
            background-color: #ff758f;
        }
        .alerta {
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: center;
        }
        .exito {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .info-actual {
            background-color: #e2e3e5;
            color: #383d41;
            padding: 10px;
            border-radius: 6px;
            font-size: 14px;
            margin-top: 15px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="contenedor-admin">
    <h2>Configuración Secreta</h2>
    <p>Introduce el número de teléfono (con código de país, ej: 34600000000) donde quieres recibir el mensaje de WhatsApp cuando respondan la encuesta.</p>
    
    <?php echo $mensaje; ?>

    <form action="admin.php" method="POST">
        <div class="grupo-formulario">
            <label for="telefono">Número de Teléfono:</label>
            <input type="text" id="telefono" name="telefono" placeholder="Ej: 34600112233" required>
        </div>
        <button type="submit">Guardar Configuración</button>
    </form>

    <?php if (!empty($telefono_actual)): ?>
        <div class="info-actual">
            <strong>Número activo actual:</strong> +<?php echo htmlspecialchars($telefono_actual); ?>
        </div>
    <?php endif; ?>
</div>

</body>
</html>