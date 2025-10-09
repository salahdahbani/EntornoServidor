<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- Formulario principal -->
<h2>Mini Diccionario Español-Inglés</h2>
<form method="get">
    <label for="palabra">Introduce una palabra en español:</label>
    <input type="text" name="palabra" id="palabra" required>
    <button type="submit">Traducir</button>
</form>

<?php
$diccionario = [
    "casa" => "house",
    "perro" => "dog",
    "gato" => "cat",
    "árbol" => "tree",
    "libro" => "book",
    "coche" => "car",
    "ciudad" => "city",
    "comida" => "food",
    "agua" => "water",
    "fuego" => "fire"
];

if (isset($_GET['traduccion'])) {
    $palabra = strtolower(trim($_GET['palabra']));
    $traduccion = strtolower(trim($_GET['traduccion']));
    if (!array_key_exists($palabra, $diccionario)) {
        $diccionario[$palabra] = $traduccion;
        echo "<p>Palabra <strong>$palabra</strong> añadida al diccionario con la traducción <strong>$traduccion</strong>.</p>";
    } else {
        echo "<p>La palabra <strong>$palabra</strong> ya existe en el diccionario.</p>";
    }
}


if (isset($_GET['palabra'])) {
    $palabra = strtolower(trim($_GET['palabra']));
    if (array_key_exists($palabra, $diccionario)) {
        echo "<h3>Traducción:</h3>";
        echo "<p><strong>$palabra</strong> en inglés es <strong>" . $diccionario[$palabra] . "</strong>.</p>";
    } else {
        echo "<h3>Traducción:</h3>";
        echo "<p>Lo siento, la palabra <strong>$palabra</strong> no está en el diccionario.</p>";
   
        echo '
        <h3>Añadir nueva palabra al diccionario</h3>
        <form method="get">
            <input type="hidden" name="palabra" value="' . htmlspecialchars($palabra) . '">
            <label for="traduccion">Introduce la traducción al inglés:</label>
            <input type="text" name="traduccion" id="traduccion" required>
            <button type="submit">Añadir</button>
        </form>
        ';  
    }
}
?>
    
</body>
</html>