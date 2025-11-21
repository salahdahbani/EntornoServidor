<?php
include_once "Menu.php";
$menu = new Menu();
if(!isset($_POST['titulo'])){
$titulo=[];
$enlace=[];
}else{
    $titulo = $_POST['titulo'];
    $enlace = $_POST['enlace'];
}

if(isset($_POST['enviar'])){
    $titulo = $_POST['titulo'];
    $enlace = $_POST['enlace'];
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
if(isset($_POST['mostrar'])){
    foreach ($titulo as $k => $t) {
        $t_safe = $t;
        $e_safe = $enlace[$k];
        $menu->añadirElemento($t_safe, $e_safe);
    if($_POST['tipo_menu'] == "horizontal"){
        echo $menu->horizontal();
    } else {
        echo $menu->vertical();
    }
}
   
}
    
?>


    
<form method="post">
    <label>Introduce los titulos:</label>
    <input type="text" name="titulo[]" >
    <label>Introduce los enlaces:</label>
    <input type="text" name="enlace[]" required>
<?php
    for ($i = 0; $i < count($titulo); $i++) {
            echo "<input type='hidden' name='titulo[]' value='".$titulo[$i]."'>";
            echo "<input type='hidden' name='enlace[]' value='".$enlace[$i]."'>";
        }
  ?>
    <input type="submit" name="enviar" value="Añadir">
</form>
<form method="post">
    <input type="submit" name="mostrar" value="Terminar">
    <select name="tipo_menu">
    <option value="horizontal">Horizontal</option>
    <option value="vertical">Vertical</option>
    </select>
</form>


</body>
</html>