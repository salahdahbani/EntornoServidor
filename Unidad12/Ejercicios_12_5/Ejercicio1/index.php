<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estilos.css">
    <title>Clima API</title>
</head>
<body>
    <h1>Consulta Meteorológica</h1>
    <div class="contenedor">
        <form action="peticion.php" method="post">
            <h2>Buscar Ciudad</h2>
            Nombre: <input type="text" name="ciudad" placeholder="Introduce una ciudad" required>
            <input type="submit" name="consultar" value="Obtener Clima">
        </form>
        <hr>
        <form action="peticion.php" method="post">
            <h2>Ciudades Favoritas</h2>
            <select name="ciudad">
                <option value="Sevilla">Sevilla</option>
                <option value="Barcelona">Barcelona</option>
                <option value="Bilbao">Bilbao</option>
                <option value="Valencia">Valencia</option>
                <option value="Madrid">Madrid</option>
                <option value="Granada">Granada</option>
                <option value="Málaga">Málaga</option>
                <option value="Cádiz">Cádiz</option>
                <option value="Córdoba">Córdoba</option>
                <option value="Alicante">Alicante</option>
                <option value="Zaragoza">Zaragoza</option>
                <option value="Valladolid">Valladolid</option>
                <option value="Salamanca">Salamanca</option>
            </select>
            <input type="submit" name="consultar" value="Consultar">
        </form>
    </div>
</body>
</html>