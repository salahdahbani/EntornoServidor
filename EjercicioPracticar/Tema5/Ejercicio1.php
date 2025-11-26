<?php
$fila = 10;
$columna = 10;
$tablero = [];
//inicializacion
for($i=0;$i<$fila;$i++){
    $tablero[$i] = [];
        for($j=0;$j<$columna;$j++){
            $tablero[$i][$j] = 0;
        }
    }
if(isset($_GET['fila'])){ 
   $filaSeleccionada =$_GET['fila'];
   $columnaSeleccionada = $_GET['columna']; 
   $tablero[$filaSeleccionada][$columnaSeleccionada] = 1;
}
        $img1 = "Img/abierto.jpg" ; 
        $img2 = "Img/cerrado.png";
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
        img {
    width: 100px;
    height: 100px;
}
        </style>
        <table border='1'>
    <?php
    for($i=0;$i<$fila;$i++){
        echo "<tr>";
        for($j=0;$j<$columna;$j++){
            echo "<td><a href='?fila=$i&columna=$j'>";
             if($tablero[$i][$j] == 1) {
             echo "<img src='$img1'>";
            }else{
                echo "<img src='$img2'>";
             
            }
            echo "</a></td>";

        }

        echo "</tr>";
    }

    ?>
     </table>
    
</body>
</html>