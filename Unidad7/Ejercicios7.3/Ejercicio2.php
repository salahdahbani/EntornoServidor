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
//Inicializamos la sesion
session_start();
if(!isset($_SESSION['numeros'])){
    $_SESSION['numeros']=[];
    $_SESSION['impares']=[];
    $_SESSION['pares']=[]; 
}

if(isset($_POST['numero'])){
    $numero = $_POST['numero'];

    $_SESSION['numeros'][] = $numero;

    if ($numero % 2 == 0) {
        $_SESSION['pares'][] = $numero;
    } else {
        $_SESSION['impares'][] = $numero;
    }

    if($numero < 0){
        if(count($_SESSION['numeros']) > 0){
            $total = count($_SESSION['numeros']);
            $suma =0;
            foreach ($_SESSION['impares'] as $impar) {
                $suma += $impar;
            }
            $mediaImpar = $suma/count($_SESSION['impares']);
            $mayorPar = $_SESSION['pares'][0];
            foreach ($_SESSION['pares'] as $n) {
                if ($n > $mayorPar) {
                 $mayorPar = $n;
                }
            }
            echo "<h3>Se han introducido " . $total . " números </h3>";
            echo "<br>";
            echo "<h3>La media de los impares es: " . $mediaImpar . " </h3>";
            echo "<br>";
            echo "<h3>El mayor de los pares es: " . $mayorPar . " </h3>";
        }else {
            echo "<h3>No se han introducido números por ahora</h3>";
        }

        session_destroy();
         echo '<br><a href="Ejercicio2.php">Volver a empezar</a>';
    }

    
}
?>

    
</body>
</html>