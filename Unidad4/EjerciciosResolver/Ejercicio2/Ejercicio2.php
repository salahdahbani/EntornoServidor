<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $cantidad = $_POST["cantidad"];
    $serie_introducida = $_POST["serie"];

    $g1 = rand(1, 49);
    $g2 = rand(1, 49);
    $g3 = rand(1, 49);
    $g4 = rand(1, 49);
    $g5 = rand(1, 49);
    $g6 = rand(1, 49);
    $serie_generada = rand(1, 999);
     ?>
    <tr>
      <td><? $g1 ?></td>
      <td><? $g2 ?></td>
      <td><? $g3 ?></td>
      <td><? $g4 ?></td>
      <td><? $g5 ?></td>
      <td><? $g6 ?></td>
    </tr>
    <br>
    

    <?php

    $aciertos=0;
    $numeroAciertos=0;

    
    if(isset($_REQUEST[$g1])){
       $numeroAciertos++;
        echo "Has acertado $numeroAciertos números";
    }

     if(isset($_REQUEST[$g2])){
       $numeroAciertos++;
        echo "Has acertado $numeroAciertos números";
    }

     if(isset($_REQUEST[$g3])){
       $numeroAciertos++;
        echo "Has acertado $numeroAciertos números";
    }

     if(isset($_REQUEST[$g4])){
       $numeroAciertos++;
        echo "Has acertado $numeroAciertos números";
    }

     if(isset($_REQUEST[$g5])){
       $numeroAciertos++;
        echo "Has acertado $numeroAciertos números";
    }

     if(isset($_REQUEST[$g6])){
       $numeroAciertos++;
        echo "Has acertado $numeroAciertos números";
    }

    if($numeroAciertos==0){
      echo "No has ganado";
    }


    if($numeroAciertos==4){
      echo "Has ganado $cantidad ";
    }

    if($numeroAciertos==5){
      echo "Has ganado  " + ($cantidad + 30)  + " euros";
    }

    if($numeroAciertos==6){
      echo "Has ganado  " + ($cantidad + 100)  + " euros";
    }

    if($serie_introducida==$serie_generada){
      echo "Has ganado  " + ($cantidad + 500)  + " euros";
    }
  
    

    echo "<table>
            <tr>
              <td>Generado</td>
              <td>$g1</td><td>$g2</td><td>$g3</td><td>$g4</td><td>$g5</td><td>$g6</td>
              <td>$serie_generada</td>
            </tr>
          </table>
          <br>";
  ?>
    
</body>
</html>