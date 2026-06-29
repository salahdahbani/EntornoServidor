<?php
// Verificamos si existe el archivo con el teléfono antes de empezar
$archivo = 'telefono.txt';
if (!file_exists($archivo) || empty(file_get_contents($archivo))) {
    echo "<div style='text-align:center; margin-top:50px; font-family:sans-serif;'>";
    echo "<h2>⚠️ ¡Falta configuración!</h2>";
    echo "<p>Primero debes entrar a <strong>admin.php</strong> y guardar tu número de teléfono.</p>";
    echo "</div>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¿Quieres salir conmigo? 🌹</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #ffe5ec, #ffc2d1);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden; /* Evita que salgan barras de scroll cuando el botón se mueva */
        }
        .contenedor {
            text-align: center;
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            max-width: 90%;
            width: 450px;
            position: relative;
        }
        h1 {
            color: #ff4d6d;
            font-size: 28px;
            margin-bottom: 30px;
        }
        .gif-placeholder {
            font-size: 50px;
            margin-bottom: 20px;
        }
        .botones {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin-top: 30px;
            min-height: 100px; /* Espacio para que el botón SI crezca sin romper el diseño */
        }
        .btn {
            padding: 15px 30px;
            font-size: 18px;
            font-weight: bold;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: background-color 0.2s, transform 0.1s;
        }
        #btn-yes {
            background-color: #2a9d8f;
            color: white;
            z-index: 10; /* Asegura que siempre quede por encima */
        }
        #btn-yes:hover {
            background-color: #21867a;
        }
        #btn-no {
            background-color: #e63946;
            color: white;
            position: relative; /* Cambiará a absolute mediante JS cuando se mueva */
            transition: all 0.2s ease;
        }
    </style>
</head>
<body>

<div class="contenedor">
    <div class="gif-placeholder">🥺👉👈</div>
    <h1>¿Te gustaría tener una cita conmigo?</h1>
    
    <div class="botones">
        <button id="btn-yes" class="btn" onclick="location.href='comida.php'">¡SÍ! 💖</button>
        <button id="btn-no" class="btn">No 💔</button>
    </div>
</div>

<script>
    const btnNo = document.getElementById('btn-no');
    const btnYes = document.getElementById('btn-yes');

    let escalaYes = 1; // Tamaño inicial del botón SÍ

    // Función que mueve el botón NO y agranda el botón SÍ
    function huirYCrecer() {
        // 1. Agrandar el botón SÍ
        escalaYes += 0.2; // Aumenta un 20% cada vez
        btnYes.style.transform = `scale(${escalaYes})`;

        // 2. Mover el botón NO a una posición aleatoria de la pantalla
        btnNo.style.position = 'absolute';
        
        // Calculamos límites para que no se salga de la pantalla
        const x = Math.random() * (window.innerWidth - btnNo.offsetWidth);
        const y = Math.random() * (window.innerHeight - btnNo.offsetHeight);
        
        btnNo.style.left = `${x}px`;
        btnNo.style.top = `${y}px`;
    }

    // Se activa cuando pasan el ratón por encima (PC)
    btnNo.addEventListener('mouseover', huirYCrecer);

    // Se activa cuando lo intentan tocar (Móviles)
    btnNo.addEventListener('touchstart', function(e) {
        e.preventDefault(); // Evita el click normal del móvil
        huirYCrecer();
    });
</script>

</body>
</html>