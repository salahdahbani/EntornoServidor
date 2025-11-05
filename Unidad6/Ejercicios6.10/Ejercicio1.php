<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
    <label><h1>Introduce la fecha</h1></label>
    <br><br>
    <label>Día: </label>
    <input type="number" name="dia" min="1" max="31" >
    <br><br>
    <label>Mes: </label>
    <input type="number" name="mes" min="1" max="12" >
    <br><br>
    <label>Año: </label>
    <input type="number" name="anio" min="1900" max="2100" >
    <br><br>
    Formato:
    <select name="formato">
        <option value="d/m/Y">d/m/Y</option>
        <option value="j-n-y">j-n-y</option>
        <option value="Y-m-d">Y-m-d</option>
        <option value="l, d F Y">l, d F Y</option>
    </select><br><br>

    <input type="submit" value="Comprobar">
</form>
<?php
if(isset($_POST['dia'])&& isset($_POST['mes']) && isset($_POST['anio'])){
    $dia=$_POST['dia'];
    $mes = $_POST['mes'];
    $anio = $_POST['anio'];
     $formato = $_POST['formato'];

    if (checkdate($mes, $dia, $anio)) {
        $fecha = strtotime("$anio-$mes-$dia");
        echo "Fecha válida: " . date($formato, $fecha);
    } else {
        echo "Fecha no válida.";
    }

}

    ?>
    
</body>
</html>