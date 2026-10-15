<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Control de Acceso</title>
</head>
<body>
<h2>Control de Acceso</h2>

<form method="post">
    <label>Perfil: </label>
    <select name="perfil">
        <option value="admin">Admin</option>
        <option value="estandar">Estándar</option>
    </select>
    <br><br>
    <label>Fila (1-5): </label>
    <input type="number" name="fila" min="1" max="5">
    <br><br>
    <label>Columna (A-E): </label>
    <input type="text" name="columna" maxlength="1">
    <br><br>
    <label>Valor: </label>
    <input type="number" name="valor">
    <br><br>
    <input type="submit" name="enviar" value="Acceder">
</form>
<?php
include "controlAcceso.php";

$mensaje = "";
$enlace = "";
$tarjeta_mostrar = "";

if(isset($_POST['enviar'])){
    $perfil = $_POST['perfil'];
    $fila = $_POST['fila'];
    $columna = $_POST['columna'];
    $valor = $_POST['valor'];

    $tarjeta = dameTarjeta($perfil);
    $tarjeta_mostrar = imprimeTarjeta($tarjeta);

    if(compruebaClave($tarjeta, $fila, $columna, $valor)){
        $mensaje = "Acceso correcto";
        $enlace = "<a href='protegida.php'>Ir a la página protegida</a>";
    } else {
        $mensaje = "Acceso incorrecto";
        $enlace = "<a href='index.php'>Volver a intentar</a>";
    }
}
?>

<?php
if($mensaje != ""){
    echo "<h3>".$mensaje."</h3>";
    echo $enlace;
    echo "<h4>Tarjeta del perfil seleccionado:</h4>";
    echo $tarjeta_mostrar;
}
?>

</body>
</html>
