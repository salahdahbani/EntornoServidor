<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    echo "<h1>Cálculo del volumen de un cilindro</h1>";
    if(isset($_POST['Enviar'])){
      $altura = $_POST['altura'];
      $diametro = $_POST['diametro'];
      $radio = $diametro / 2;
      $area_base = pi() * pow($radio, 2);
      $volumen = $area_base * $altura;
      echo "<h2>El volumen del cilindro es: " . round($volumen, 2) . " m³</h2>";
      echo "<br><img src='cilindro.png' alt='Cilindro' width='200'>";
      echo "<br><a href='Formulario.php'>Volver al formulario</a>";
    }
    ?>
    
</body>
</html>