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
    <?php
    echo "<table border=1>
        <tr>
        <th>Num</th>
        <th>Nombre</th>
        <th>Sexo</th>
        <th>Orientacion</th>
        </tr>";
        foreach ($personas as $i => $item){ ?>
        <tr>
        <td><?php echo $i + 1 ?> </td>
        <td> <?php echo $item['nombre'] ?> </td>
        <td> <?php echo $item['sexo'] ?> </td>
        <td> <?php echo $item['orientacion'] ?> </td>
        <td><form method="post"><input type="hidden" name="personas" value="<?php echo base64_encode(serialize($personas))?>">
            <input type="submit" name="seleccionar" value="Seleccionar">
            <input type="hidden" name="idx" value="<?php echo $i; ?>">
            <input type="hidden" name="name" value="<?php echo $item['nombre'] ?>">
        </form></td>
        </tr>
            <?php

        }
        echo "</table>";
        
        if(isset($_POST['seleccionar'])){
            $sel = $_POST['idx'];
            if(isset($_POST['name'])){
            $name = $_POST['name'];
            echo "<br><br>
        <h3>Parejas compatibles con $name</h3>";
            }
        echo "<table border=1>";
            foreach ($personas as $i => $item){ 
                        $a = $personas[$sel];
                        $b = $personas[$i];
                        $comp = false;
                        if ($a['orientacion'] === 'het') {
                            if ($a['sexo'] !== $b['sexo'] && $b['orientacion'] !== 'hom') $comp = true;
                        } elseif ($a['orientacion'] === 'hom') {
                            if ($a['sexo'] === $b['sexo'] && $b['orientacion'] !== 'het') $comp = true;
                        } elseif ($a['orientacion'] === 'bis') {
                            if (!($b['orientacion']==='het' && $a['sexo']===$b['sexo']) && !($b['orientacion']==='hom' && $a['sexo']!==$b['sexo'])) $comp = true;
                        }

                        if ($comp){
                    ?>
        <tr>
        <td><?php echo $i ?> </td>
        <td> <?php echo $b['nombre'] ?> </td>
        <td> <?php echo $b['sexo'] ?> </td>
        <td> <?php echo $b['orientacion'] ?> </td>
        <td> <form  method="post" action="FormarPareja.php">
        <input type="hidden" name="personas" value="<?php echo base64_encode(serialize($personas))?>">
        <input type="hidden" name="idxPareja" value="<?php echo $i; ?>">
        <input type="hidden" name="idx" value="<?php echo $sel; ?>">
            <input type="hidden" name="name" value="<?php echo $name ?>">
        <input type="hidden" name="name2" value="<?php echo $b['nombre'] ?>">    
        <input type="submit" name="formar" value="Formar Pareja"></form> </td>
        </tr>
<?php
        }
    }
    }
    ?>
    </table>
</body>
</html>
