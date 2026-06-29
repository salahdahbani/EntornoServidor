<?php
$tiempo = date("d/m/Y H:m:s") . "-" . $_SESSION['concesionario']['concesionario'];
    setcookie("acceso",$tiempo, time() + 3600*24*30*3);
   
 if (isset($_COOKIE["acceso"])) {
$tiempo = $_COOKIE["acceso"];
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
    <h2>Inicia Sesión con un concesionario</h2>

    <p>Ultimo acceso:<?= $tiempo ?> </p>

<form action="index.php?action=login" method="post" >
    <label>Nombre de concesionario:</label>
    <input type="text" name="concesionario">
    <br>

    <br>
    <input type="hidden" value="<?php echo $_SESSION['concesionario']?>">
    <input type="submit" value="Login" name="entrar">
    <br><br>
</form>

    
</body>
</html>