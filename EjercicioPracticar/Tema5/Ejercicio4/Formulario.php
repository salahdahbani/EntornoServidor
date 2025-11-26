<?php
if(!isset($_POST['personas'])){
$personas= [['nombre'=>'Anita','sexo'=>'m','orientacion'=>'bis'],
['nombre'=>'Lolita','sexo'=>'m','orientacion'=>'bis'],
['nombre'=>'Pepito','sexo'=>'h','orientacion'=>'bis'],
['nombre'=>'Juanito','sexo'=>'h','orientacion'=>'bis'],
['nombre'=>'Roberto','sexo'=>'h','orientacion'=>'het'],
['nombre'=>'Antonio','sexo'=>'h','orientacion'=>'het'],
['nombre'=>'Manuela','sexo'=>'m','orientacion'=>'het'],
['nombre'=>'Isabel','sexo'=>'m','orientacion'=>'het'],
['nombre'=>'Jenifer','sexo'=>'m','orientacion'=>'hom'],
['nombre'=>'Susan','sexo'=>'m','orientacion'=>'hom'],
['nombre'=>'Peter','sexo'=>'h','orientacion'=>'hom'],
['nombre'=>'Mike','sexo'=>'h','orientacion'=>'hom']];
}else{
    $personas = @unserialize(base64_decode($_POST['personas']));
}
if(isset($_POST['añadir'])){
$nombre = $_POST['nombre'];
$sexo = $_POST['sexo'];
$orientacion = $_POST['orientacion'];
$personas[] = ['nombre' => $nombre,'sexo'=>$sexo,'orientacion'=>$orientacion];
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
    <form method="post">
        <input type="hidden" name="personas" value="<?php echo base64_encode(serialize($personas))?>">
        <label>Nombre:</label>
        <input type="text" value="" name="nombre">
        <br><br>
        <label>sexo:</label>
        <select name="sexo">
            <option value="h">H</option>
            <option value="m">M</option>
            </select>
            <br><br>
        <label>Orientacion:</label>
        <select name="orientacion">
            <option value="bis">bis</option>
            <option value="het">het</option>
            <option value="hom">hom</option>    
        </select>
        <br><br>
        <input type="submit" name="añadir" value="Añadir">
    </form>
<form method="post" action="Ejercicio4.php">
        <input type="hidden" name="personas" value="<?php echo base64_encode(serialize($personas))?>">
        <input type="submit" name="mostrar" value="Mostrar"> 
    </form>
    <?php
    if(isset($_POST['añadir'])){
        echo "<table border=1>
        <tr>
        <th>Num</th>
        <th>Nombre</th>
        <th>Sexo</th>
        <th>Orientacion</th>
        </tr>";
        for($i=0;$i<count($personas);$i++){
            ?>
            <tr>
                <td><?php echo $i ;?></td>
                <td><?php echo $personas[$i]['nombre']; ?></td>
                <td><?php echo $personas[$i]['sexo']; ?></td>
                <td><?php echo $personas[$i]['orientacion'];?></td>
            </tr>
            <?php

        }
        echo "</table>";
    }
    ?>
</body>
</html>