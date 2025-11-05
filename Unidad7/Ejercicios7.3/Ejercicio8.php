<?php
if($_POST['accion' == "actualizarCookies"]){
    foreach($_SESSION['diccionario'] as $espaniol => $ingles){
        setcookie()
    }
}
if(!isset($_SESSION['diccionario'])){
 $_SESSION['diccionario'] = array (
    "perro" => "dog",
    "gato" => "cat",
    "silla" => "chair",
    "coche" => "car",
    "torre" => "tower",
    "raton" => "mouse",
    "Ejercicio" => "Exercise",
    "gimnasio" => "gym"
 );
}



if (isset($_POST['comprobar'])) {
    $palabra = $_POST['palabra'];
    $traduccion = $_POST['traduccion'];

    if (isset($Diccionario[$palabra]) && $$Diccionario[$palabra] == $traduccion) {
        $_COOKIE['palabra'] = $palabra;
    } else {
        $error = "La ";
    }
}
      




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>