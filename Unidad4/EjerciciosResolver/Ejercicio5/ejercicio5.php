<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<table border="1px" border-color="black">

<?php
$fila= isset($_GET['fila']) ? $_GET["fila"] : 0;
$columna= isset($_GET['columna']) ? $_GET["columna"] : 0;
 
$img1='cerrado.png';
$img2='abierto.jpg';


for($i=0;$i<10;$i++){
    echo "<tr>";
    for($j=0;$j<10;$j++){
        echo "<td>";
        echo "<a href='?fila=$i&columna=$j'>";
        if($i == $fila && $j ==$columna){
        echo "<img src='abierto.jpg' width='10' height='10'>";
        } else {
        echo "<img src='cerrado.png' width='10' height='10'>";
        }
    }
    echo "</a>";
    echo "</td>";
}
echo "</tr>";
?>

</table>
    
</body>
</html>