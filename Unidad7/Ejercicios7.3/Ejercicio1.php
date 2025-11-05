<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form method="post">
    <label>Introduce los números</label>
    <input type="number" name="numero">
    <button type="submit">Añadir</button>

</form>

<?php
session_start();
//Inicializamos la sesion
if(!isset($_SESSION['numeros'])){
    $_SESSION['numeros']=[]; 
}

if(isset($_POST['numero'])){
    $numero = $_POST['numero'];

    if($numero>= 0){
        $_SESSION['numeros'][]=$numero;
    }else {

        if(count($_SESSION['numeros']) > 0){
            $suma = 0;
            foreach($_SESSION['numeros'] as $n){
                $suma += $n;
            }
            $media = $suma/count($_SESSION['numeros']);
            echo "<h3>La media es: " . $media . " </h3>";
        }else {
            echo "<h3>No se han introducido números por ahora</h3>";
        }

        session_destroy();
         echo '<br><a href="Ejercicio1.php">Volver a empezar</a>';
    }
}
?>

    
</body>
</html>