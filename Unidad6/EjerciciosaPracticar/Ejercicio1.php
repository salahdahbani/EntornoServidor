<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Primitiva Aleatoria</title>
</head>
<body>
<h2>Generador de combinación de la Primitiva</h2>

<form method="post">
    <p>Introduce los números que quieras (1-49), deja en blanco los restantes:</p>
    <?php for($i=1;$i<=6;$i++): ?>
        <input type="number" name="num<?php echo $i; ?>" min="1" max="49" style="width:50px;">
    <?php endfor; ?>
    <br><br>
    <label>Número de serie (1-999, opcional): </label>
    <input type="number" name="serie" min="1" max="999" style="width:80px;">
    <br><br>
    <label>Título de la combinación (opcional): </label>
    <input type="text" name="titulo" style="width:300px;">
    <br><br>
    <input type="submit" name="enviar" value="Generar combinación">
</form>

<?php
function combinacion($numeros_usuario, $serie_usuario = null) {
    $combinacion = [];

    $numeros_usuario_filtrados = [];
    for($i=0; $i<count($numeros_usuario); $i++){
        $n = intval($numeros_usuario[$i]);
        if($n >= 1 && $n <= 49){
            $numeros_usuario_filtrados[] = $n;
        }
    }

    $combinacion = $numeros_usuario_filtrados;

    while(count($combinacion) < 6){
        $num = rand(1,49);
        $duplicado = false;
        for($i=0;$i<count($combinacion);$i++){
            if($combinacion[$i] == $num){
                $duplicado = true;
                break;
            }
        }
        if(!$duplicado) $combinacion[] = $num;
    }

    for($i=0;$i<5;$i++){
        for($j=$i+1;$j<6;$j++){
            if($combinacion[$i] > $combinacion[$j]){
                $tmp = $combinacion[$i];
                $combinacion[$i] = $combinacion[$j];
                $combinacion[$j] = $tmp;
            }
        }
    }
    $serie = intval($serie_usuario);
    if($serie < 1 || $serie > 999){
        $serie = rand(1,999);
    }

    return ['numeros' => $combinacion, 'serie' => $serie];
}


function imprimeApuesta($apuesta, $titulo = ""){
    if($titulo == "") $titulo = "Combinación generada para la Primitiva";

    $numeros_str = "";
    for($i=0;$i<count($apuesta['numeros']);$i++){
        if($i>0) $numeros_str .= ", ";
        $numeros_str .= $apuesta['numeros'][$i];
    }


    $serie = $apuesta['serie'];
    if($serie < 10){
        $serie_str = "00".$serie;
    } elseif($serie < 100){
        $serie_str = "0".$serie;
    } else {
        $serie_str = $serie;
    }

    return "
    <table border='1' cellpadding='5' >
        <tr><th colspan='2'>{$titulo}</th></tr>
        <tr>
            <td>Números</td><td>{$numeros_str}</td>
        </tr>
        <tr>
            <td>Serie</td><td>{$serie_str}</td>
        </tr>
    </table>
    ";
}


$apuesta_generada = null;
if(isset($_POST['enviar'])){
    $numeros_usuario = [];
    for($i=1;$i<=6;$i++){
        $num = $_POST["num$i"];
        if($num != ""){
            $numeros_usuario[] = $num;
        }
    }

    $serie_usuario = $_POST['serie'];
    $titulo = $_POST['titulo'];

    $apuesta_generada = combinacion($numeros_usuario, $serie_usuario);
    $html_apuesta = imprimeApuesta($apuesta_generada, $titulo);
}
?>


<?php
if($apuesta_generada){
    echo "<h3>Resultado:</h3>";
    echo $html_apuesta;
}
?>

</body>
</html>
