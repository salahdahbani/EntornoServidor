<?php 
$archivo = "mascotas.txt" ;
if(session_status() == PHP_SESSION_NONE) session_start();
$fechaActual = "#" . date("d/m/Y") . "#";

if(!isset($_SESSION['mascotas'])){
    $_SESSION['mascotas'] = [];
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="1">
        <tr>
            <th colspan="4">Fecha Actual:<?php echo $fechaActual; ?></th>
        </tr>
        <tr>
            <td>Nombre</td>
            <td>Animal</td>
            <td>Edad</td>
            

        </tr>
        
        <?php
        foreach($_SESSION['mascotas'] as $mascota => $datos){   
            echo "<tr>";
            echo "<td>" . $datos['nombre'] . "</td>";
            echo "<td>" . $datos['animal'] . "</td>";
            echo "<td>" . $datos['edad'] . "</td>";
            echo "</tr>";
        }
        ?>
        <?php
    if(isset($_POST['add'])){
        $nombre = $_POST['nombre'];
        $animal = $_POST['animal'];
        $edad = $_POST['edad'];

        $_SESSION['mascotas'][] = [
            'nombre' => $nombre,
            'animal' => $animal,
            'edad' => $edad
        ];
    
    ?>
       <tr>
            <td><?php echo $nombre; ?></td>
            <td><?php echo $animal; ?></td>
            <td><?php  echo $edad; ?></td>
       </tr>
       <?php 
    }
       ?>

        <tr>
            <form method="post">
            <td><input type="text" name="nombre" required></td>
            <td><input type="text" name="animal" required></td>
            <td><input type="number" name="edad" required></td>
            <td><button name="add" >Añadir</button></td>
            </form>
        </tr>
        

    </table>

    <?php 
    if(isset($_POST['grabar'])){
        session_destroy();
        $archivo = fopen("mascotas.txt", "a");
        foreach($_SESSION['mascotas'] as $mascota => $datos){
            if(!$fechaActual){
                fwrite($archivo ,$fechaActual . PHP_EOL);
                $linea = $datos['nombre'] . "," . $datos['animal'] . "," . $datos['edad'] . PHP_EOL;
                fwrite($archivo, $linea);
            }elseif($fechaActual != "#".date("d/m/Y")."#"){
                $lineaFecha = PHP_EOL . $fechaActual . PHP_EOL;
                fwrite($archivo, $lineaFecha);
                $linea = $datos['nombre'] . "," . $datos['animal'] . "," . $datos['edad'] . PHP_EOL;
                fwrite($archivo, $linea);
            }
            
        }
        fclose($archivo);
        echo "<p>Datos grabados en mascotas.txt</p>";
    }
    ?>
    

    <br>
    <br>

    <form method="post">
        Grabar en fichero:
        <button type="submit" name="grabar" >Grabar</button>
    </form>
    
</body>
</html>