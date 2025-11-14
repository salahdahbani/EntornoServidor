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
    $suma_actual= 0;

     $_SESSION['numeros'][] = $numero;
    $_SESSION['numeros'] = $_SESSION['numeros'] + $suma_actual;
    $nueva_suma = $suma_actual+ $numero;


        if($nueva_suma > 10000){ 
            $suma = ($_SESSION['numeros']) + $suma;
            $total = count($_SESSION['numeros']);
            $media = $suma / $total;

            echo "<h2>Se ha superado el límite de 10.000.</h2>";
            echo "<h3>El total de numeros es: " . $total . " números </h3>";
            echo "<h3>La media es: " . $media . " </h3>";
            echo "<h3>Suma final: $suma</h3>";
        

        session_destroy();
         echo '<br><a href="Ejercicio3.php">Volver a empezar</a>';
            
        }
          
    
            
    }




?>

    
</body>
</html>