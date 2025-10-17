<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   
   
    <form methot="post">
        <label for="numero">Introduce el  número:</label>
        <input type="number" name="numero" id="numero" required>
        <button type="submit">Enviar</button>
    </form>
    <?php
    
    if (isset($_POST['numero'])) {
        $numero = $_POST['numero'];
        foreach ($numero as $num) {
        echo "<p>Los números introducidos son: <strong>$numero</strong></p>";
        }
    }
    ?>

    
</body>
</html>