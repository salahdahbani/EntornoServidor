<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php
     if(isset($_POST['LLamar'])) {
        $i=$_POST['i'];
        $j=$_POST['j'];
        echo "<h3>Usted ha llamado al piso $j del bloque $i</h3>";
     }
    
    
    
    ?>


<table border="1px" border-color="black">
    <tr>
        <th>Nº Bloque</th>
        <th>Piso</th>
        <th>Acción</th>
    </tr>


<?php

for($i=1;$i<=10;$i++){
    for($j=1;$j<=7;$j++){
       echo "<tr>";
       echo  "<td> $i </td>";
        echo "<td>$j</td>";
       echo "<td>
       <form method='POST' style='margin:0;'>
       <input type='hidden' name='i' value='$i'>
              <input type='hidden' name='j' value='$j'> 
        <button type='submit'>LLamar</button>
       </form>
       </td>";
       echo "</tr>";
       

    }
}

?>
</table>


    
</body>
</html>