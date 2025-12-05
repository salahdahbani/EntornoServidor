<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="1">
    <?php
    for($i=1;$i<11;$i++){
            for($j=1;$j<8;$j++){
                ?>
                <tr>
                    
        <td><?php echo "Bloque " . $i?></td>
                <td><?php echo "Piso " . $j?></td>
                <td>
                    <form method="post" action="Mensaje.php">
                    <input type="submit" value="Llamar" name="Llamar">
                <input type="hidden" value="<?php echo $i  ?>" name = "i">
                <input type="hidden" value="<?php echo $j ?>" name = "j">
                    </form>
                    </td>
                </tr>
                <?php
            }
            ?>
        
        <?php
    }
    ?>
    </table>
    
</body>
</html>