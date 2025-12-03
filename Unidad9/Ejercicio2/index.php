<?php
include_once "Menu.php";
<<<<<<< HEAD
session_start();

if(!isset($_SESSION['menu'])){
    $menu = new Menu();
    $_SESSION['menu'] = base64_encode(serialize($menu));
} else {
    $menu = unserialize(base64_decode($_SESSION['menu']));
}

$menu_html = '';
if(isset($_POST['enviar'])){
    $menu->aniadirElemento($_POST['titulo'], $_POST['enlace']);
    $_SESSION['menu'] = base64_encode(serialize($menu));
}
=======
$menu = new Menu();
$menu_html = '';
if(!isset($_POST['titulo'])){
$titulo=[];
$enlace=[];
}else{
    $titulo = $_POST['titulo'];
    $enlace = $_POST['enlace'];
}


for ($i = 0; $i < count($titulo); $i++) {
    $menu->añadirElemento($titulo[$i], $enlace[$i]);
}

>>>>>>> 80591ae (Trabajo local: cambios en Unidad9/Ejercicio2 (respaldo))
if(isset($_POST['mostrar'])){
    if($_POST['tipo_menu'] == "horizontal"){
        $menu_html = $menu->horizontal();
    } else {
        $menu_html = $menu->vertical();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Dinámico</title>
</head>
<body>

<h2>Agregar elementos al menú</h2>
<form method="post">
    <label>Título:</label>
    <input type="text" name="titulo" required>
    <label>Enlace:</label>
    <input type="text" name="enlace" required>
    <input type="submit" name="enviar" value="Añadir">
</form>

<h2>Mostrar menú final</h2>
<form method="post">
    <label>Tipo de menú:</label>
    <select name="tipo_menu">
        <option value="horizontal">Horizontal</option>
        <option value="vertical">Vertical</option>
    </select>
    <input type="submit" name="mostrar" value="Terminar">
</form>

<?php
    echo "<h3>Menú generado:</h3>";
    echo $menu_html;
?>

</body>
</html>
