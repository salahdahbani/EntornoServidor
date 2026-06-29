<?php
session_start(); // Iniciamos la sesión para guardar la respuesta

// Si ya viene de elegir la comida, guardamos y vamos al día
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comida'])) {
    $_SESSION['cita_comida'] = $_POST['comida'];
    header('Location: hora.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¿Qué comeremos? 🍕</title>
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
    <h2>¿Qué te apetece comer? 😋</h2>
    <form action="comida.php" method="POST" class="opciones">
        <button type="submit" name="comida" value="Pizza 🍕" class="btn-opcion">Pizza 🍕</button>
        <button type="submit" name="comida" value="Hamburguesas 🍔" class="btn-opcion">Hamburguesas 🍔</button>
        <button type="submit" name="comida" value="Sushi 🍣" class="btn-opcion">Sushi 🍣</button>
        <button type="submit" name="comida" value="Algo elegante/Restaurante 🍷" class="btn-opcion">Algo elegante 🍷</button>
    </form>
</div>
</body>
</html>