<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>MVC Clima</title>
    <style>
        /* Estilos básicos para que se vea bien */
        body { font-family: sans-serif; background: #222; color: #fff; display: flex; justify-content: center; padding-top: 50px; }
        .card { background: #333; padding: 20px; border-radius: 10px; width: 400px; box-shadow: 0 4px 15px rgba(0,0,0,0.5); }
        h1 { text-align: center; color: #f0a500; }
        input, select, button { width: 100%; padding: 10px; margin: 10px 0; border-radius: 5px; border: none; }
        button { background: #f0a500; color: #000; font-weight: bold; cursor: pointer; }
        button:hover { background: #d48f00; }
        .clima-info { background: #444; padding: 15px; border-radius: 5px; margin-top: 15px; text-align: center; }
        .error { color: #ff6b6b; text-align: center; background: rgba(255,0,0,0.1); padding: 10px; }
    </style>
</head>
<body>

<div class="card">
    <h1>Consultar Clima</h1>
    
    <form action="index.php" method="POST">
        <label>Escribe ciudad:</label>
        <input type="text" name="ciudad_texto" placeholder="Ej: Madrid">
        
        <label>O selecciona:</label>
        <select name="ciudad_select">
            <option value="" selected disabled>-- Seleccionar --</option>
            <option value="Sevilla,ES">Sevilla</option>
            <option value="Bogota,CO">Bogotá</option>
            <option value="Mexico City,MX">Ciudad de México</option>
            <option value="Tokyo,JP">Tokio</option>
        </select>

        <button type="submit">Ver Tiempo</button>
    </form>

    <?php if ($error): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

    <?php if ($resultado): ?>
        <div class="clima-info">
            <h2><?php echo $resultado->name; ?>, <?php echo $resultado->sys->country; ?></h2>
            <img src="http://openweathermap.org/img/w/<?php echo $resultado->weather[0]->icon; ?>.png">
            <h3><?php echo $resultado->main->temp; ?> ºC</h3>
            <p><?php echo ucfirst($resultado->weather[0]->description); ?></p>
            <p>Humedad: <?php echo $resultado->main->humidity; ?>% | Viento: <?php echo $resultado->wind->speed; ?> m/s</p>
        </div>
    <?php endif; ?>
</div>

</body>
</html>