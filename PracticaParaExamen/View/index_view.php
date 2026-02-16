<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Listado de productos</title>
</head>
<body>
<hr>
<table border="1" color="black">
            <tr><th colspan="3"><br><h2><?= $_SESSION['usuario'] ?></h2><br><br></th></tr>

    <tr>
        <td>Descripcion</td>
        <td>Autor</td>
        <td>Estado</td>
   
    </tr>
<?php
foreach($data['tickets'] as $ticket) {
?>
    <tr>
        <td><?=$ticket['descripcion']?></td>
        <td><?=$ticket['autor']->getNombre()?></td>
        <td><?=$ticket['estado']?></td>
    </tr>
<?php
}
?>
</table>
<br>
<br>
<a href="../Controller/logout.php">Volver al inicio</a>
</body>
</html>