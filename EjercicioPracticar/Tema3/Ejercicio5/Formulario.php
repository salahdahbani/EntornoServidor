<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>  
    <form action="Ejercicio5.php" method="post">
        <label>Diámetro:</label>
        <input type="number" id="diametro" name="diametro" step="0.01" required>
        <br><br>
        <label>Altura:</label>
        <input type="number" id="altura" name="altura" step="0.01" required>
        <br><br>
        <label>Caudal(L/min):</label>
        <input type="number" id="caudal" name="caudal" required>
        <br><br>
        <input type="submit" value="Enviar" name="Enviar">
    </form>
    
</body>
</html>