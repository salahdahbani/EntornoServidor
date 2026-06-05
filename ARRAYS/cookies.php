<?php
if(isset($_POST['enviar'])){
    $nombre = $_POST['nombre'];
    setcookie("nombre",$nombre, time() + 3600);
   
}else if (isset($_COOKIE["nombre"])) {
$nombre = $_COOKIE["nombre"];
}
// Borrado de cookies y variables
if (isset($_POST["borrar"])) {
setcookie("nombre", "", -1);
unset($nombre);
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
        nombre:
        <input type="text" name="nombre">
        <input type="submit" value="crear cookie" name="enviar">
        <input type="submit" value="borrar cookie" name="borrar">
    </form>
    <?php
  if(!isset($nombre)){
    echo "No has introducido ningun nombre";

  } else {

  echo "El nombre es : ". $nombre;
  }
    ?>
    
</body>
</html>