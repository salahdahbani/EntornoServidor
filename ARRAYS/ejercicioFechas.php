<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $mesesAnio = ["enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre"];
    $diasemanas = ["domingo","lunes","martes","miércoles","jueves","viernes","sábado"];
    if(isset($_POST['enviar'])){
    $fecha = $_POST['fecha'];
    $numeroMes = date("n",strtotime($fecha)) - 1;
    $numeroSemana = date("w",strtotime($fecha));
    echo "El dia ". date("d",strtotime($fecha)). " corresponde a " . $diasemanas[$numeroSemana] . " <br>";
    echo date("d",strtotime($fecha)) . " de " . $mesesAnio[$numeroMes] . " de " . date("Y",strtotime($fecha));
}

if(isset($_POST['env'])){
    $diaSeleccionado = $_POST['select'];
    echo $diaSeleccionado;
}
    
    ?>

<form method="post">
    <span>FECHA:</span>
    <input type="date" name="fecha">
    <input type="submit" name="enviar" value="enviar">
</form>

<form method="post">
    <span>Día:</span>
    
    <select name="select">
        <?php
    foreach($diasemanas as $dia => $valor) {
        ?>
        <option value="<?= $valor ?>"><?= $valor ?> </option>
     <?php
    }
    ?>
    </select>
   
    <input type="submit" name="env" value="enviar">
</form>
    
</body>
</html>