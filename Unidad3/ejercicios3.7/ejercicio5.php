<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documento</title>
</head>
<body>
    <?php
    $diametro= $_POST["diametro"];
    $altura= $_POST["altura"];
    $caudal= $_POST["caudal"];
    $radio= $diametro/2;

    $volumen= pi() * $radio* $radio *$altur+a;
    $volumen_litros= $volumen * 1000;

    $tiempo=round ($volumen_litros / $caudal, 2);

    $horas=floor($tiempo/60);
    $minutos=round($tiempo%60);
   

        echo "Tarda en llenarse $horas horas y $minutos minutos";
   
    
    ?>
    
</body>
</html>