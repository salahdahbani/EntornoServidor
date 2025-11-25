<?php
if(isset($_GET['fila'])){
    $fila = $_GET['fila'];
    $columna = $_GET['columna'];
}else{
    $fila =0;
    $columna = 0;
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
        <form method="post">
    <table border="1">
    <?php
    for($i=1;$i<11;$i++){
        echo "<tr>";
        for($j=1;$j<11;$j++){
            echo "<td><a href='?fila=$i&columna=$j'>";
            if($fila == $i && $columna == $j ) {
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
        </form>
    
</body>
</html>