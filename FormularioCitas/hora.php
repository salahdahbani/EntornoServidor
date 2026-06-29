<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hora'])) {
    $_SESSION['cita_hora'] = $_POST['hora'];
    header('Location: final.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¿A qué hora? ⏰</title>
    <style>
        body {
            margin: 0; font-family: sans-serif;
            background: linear-gradient(135deg, #ffe5ec, #ffc2d1);
            height: 100vh; display: flex; justify-content: center; align-items: center;
        }
        .contenedor {
            text-align: center; background: white; padding: 40px;
            border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            width: 90%; max-width: 400px;
        }
        h2 { color: #ff4d6d; margin-bottom: 25px; }
        .opciones { display: flex; flex-direction: column; gap: 15px; }
        .btn-opcion {
            padding: 15px; font-size: 16px; font-weight: bold;
            background-color: #f8f9fa; border: 2px solid #ffccd5;
            border-radius: 12px; cursor: pointer; transition: all 0.2s;
        }
        .btn-opcion:hover { background-color: #ff4d6d; color: white; border-color: #ff4d6d; }
    </style>
</head>
<body>
<div class="contenedor">
    <h2>¿A qué hora nos vemos? ⏰</h2>
    <form action="hora.php" method="POST" class="opciones">
        <button type="submit" name="hora" value="Para comer (Mediodía)" class="btn-opcion">Para comer ☀️</button>
        <button type="submit" name="hora" value="Para cenar (Noche)" class="btn-opcion">Para cenar 🌙</button>
        <button type="submit" name="hora" value="A media tarde (Café/Merienda)" class="btn-opcion">A media tarde ☕</button>
    </form>
</div>
</body>
</html>