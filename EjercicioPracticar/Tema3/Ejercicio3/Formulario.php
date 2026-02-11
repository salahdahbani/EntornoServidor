<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="Ejercicio3.php" method="post">
        <label for="nombre">Color de fondo(ingles):</label>
        <input type="text" id="nombre" name="color_fondo" required>
        <br><br>
        <label for="email">Texto:</label>
        <input type="text"  name="texto" required>
        <br><br>
        <label for="email">Color de texto(ingles):</label>
        <input type="text"  name="color_texto" required>
        <br><br>
        <label for="email">Tamaño de texto:</label>
        <input type="number"  name="tamano_texto" required>
        <br><br>
        <label for="email">Fuente de texto:</label>
        <select name="fuente" required>
            <option value="Arial">Arial</option>
            <option value="Verdana">Verdana</option>
            <option value="Helvetica">Helvetica</option>
            <option value="Times New Roman">Times New Roman</option>
            <option value="Courier New">Courier New</option>
        </select>
        
        <br><br>
        <input type="submit" value="Enviar" name="Enviar">
    </form>
    
</body>
</html>