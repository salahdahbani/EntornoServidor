<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
        table, th, td {
    border: solid black;
}
img {
    width: 100px;
    height: 100px;
}
        </style>
       
        <?php
         $contador = 0;
         if(isset($_GET['contador'])){
            $contador = $_GET['contador'] ;
         }
         if(isset($_GET['ImagenSeleccionada'])) {
            $ImagenSeleccionada = $_GET['ImagenSeleccionada'];
            $contador++;
        } else {
            $ImagenSeleccionada = 0;
        }
     
        for($i=1;$i<10;$i++){
        $img[$i] = ($ImagenSeleccionada == $i) ? 'ImagenGato/Imagen_' . $i . '.png' : 'ImagenGato/gris_' . $i . '.jpg';
        }
        echo "Número de intentos " . $contador ;
        ?>
    <form method="post">
        <label>Introduce el nombre de la imagen:</label>
        <input type="text" id="nombre_imagen" name="nombre_imagen" required>
        <br><br>
        <input type="submit" value="Enviar" name="Enviar">
    </form>
    <br><br>
        <form method="post">
        <table>
                <tr>
                     <?php
            for($i=1;$i<=3;$i++){
                ?>
                <td><a href="?ImagenSeleccionada=<?php echo $i;?>&contador=<?php echo $contador;?>"><img src="<?php echo $img[$i]; ?>" ></a></td>
            <?php
            }
            ?>
                </tr>
                <tr>
                     <?php
            for($i=4;$i<=6;$i++){
                ?>
                <td><a href="?ImagenSeleccionada=<?php echo $i;?>&contador=<?php echo $contador;?>"><img src="<?php echo $img[$i]; ?>" ></a></td>
            <?php
            }
            ?>
                </tr>
                <tr>
                     <?php
            for($i=7;$i<=9;$i++){
                ?>
                <td><a href="?ImagenSeleccionada=<?php echo $i;?>&contador=<?php echo $contador;?>"><img src="<?php echo $img[$i]; ?>" ></a></td>
            <?php
            }
            ?>
                </tr>
          
        </table>
        
        
    </form>
    <?php
    if(isset($_POST['Enviar'])){
        $nombreImagen = $_POST['nombre_imagen'];
        
    if($nombreImagen === 'gato' || $nombreImagen === 'GATO' || $nombreImagen === 'Gato'){

        echo "<h2>¡Respuesta Correcta!</h2>";
        echo "<h3>Número de intentos " . $contador . " </h3>";
        
    echo "<table border='1'>";
    echo "<tr>";
    echo "<td><img src='ImagenGato/Imagen_1.png' alt='Imagen'></td>";
    echo "<td><img src='ImagenGato/Imagen_2.png' alt='Imagen'></td>";
    echo "<td><img src='ImagenGato/Imagen_3.png' alt='Imagen'></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td><img src='ImagenGato/Imagen_4.png' alt='Imagen'></td>";
    echo "<td><img src='ImagenGato/Imagen_5.png' alt='Imagen'></td>";
    echo "<td><img src='ImagenGato/Imagen_6.png' alt='Imagen'></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td><img src='ImagenGato/Imagen_7.png' alt='Imagen'></td>";
    echo "<td><img src='ImagenGato/Imagen_8.png' alt='Imagen'></td>";
    echo "<td><img src='ImagenGato/Imagen_9.png' alt='Imagen'></td>";
    echo "</tr>";
    echo "</table>";
    }else{
        echo "Nombre de imagen no válido.";
    
}
    }

    ?>


   
    

    

</body>
</html>