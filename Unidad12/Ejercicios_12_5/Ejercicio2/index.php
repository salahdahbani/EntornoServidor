<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Buscador de Cine</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body style="text-align: center;">

    <h1>Buscador de Peliculas API</h1>
    
    <div class="form-container">
        <form action="peticion.php" method="GET">
            <input type="text" name="busqueda" placeholder="Nombre de la película...">
            
            <select name="anio">
                <option value="">Año</option>
                <?php for($i=2026; $i>=1980; $i--) echo "<option value='$i'>$i</option>"; ?>
            </select>

            <select name="genero">
                <option value="">Género</option>
                <option value="28">Acción</option>
                <option value="35">Comedia</option>
                <option value="27">Terror</option>
                <option value="878">Ciencia Ficción</option>
            </select>

            <input type="submit" name="buscar" value="BUSCAR" class="btn-enviar">
        </form>
    </div>

</body>
</html>