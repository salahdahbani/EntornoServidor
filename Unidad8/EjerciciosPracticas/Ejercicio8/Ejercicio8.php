 <?php
$archivo = "archivo.txt" ;

    

if(isset($_POST['guardar'])){
    $fp = fopen($archivo, "a");
    $texto = $_POST['texto'];
    fwrite($fp, $texto . PHP_EOL);
    fclose($fp);
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
    <label for="titulo">Introduce el texto:</label>
    <input type="text" id="texto" name="texto" >
    <br>
    <button type="submit" name="guardar" >Guardar</button>
    <button type="submit" name="terminar" >Terminar</button>
    </form>

 <?php  
if(isset($_POST['terminar'])){
    if(file_exists($archivo)){
    echo "<h2>Contenido del archivo:</h2>";
$fp = fopen($archivo, "r");
    while(!feof($fp)){
    $linea = fgets($fp);
    echo $linea . "<br>";
}
fclose($fp);
?>
<a href="<?php echo $archivo; ?>">Descargar archivo</a>
<form method="post">
    <button type="submit" name="reiniciar" >Reiniciar</button>
    </form>
<?php
}else{
    echo "El archivo no existe.";
}
}
if(isset($_POST['reiniciar'])){
    unlink($archivo);
}
?>
                                                                 
    
</body>
</html>