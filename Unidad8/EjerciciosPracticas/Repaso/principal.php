<?php
session_start();


if(!isset($_SESSION['texto'])){
    $_SESSION['texto']= [];
}

if(isset($_SESSION['user'])){
   $user = $_SESSION['user'];
}

if(isset($_POST['add'])){
    $titulo = $_POST['titulo'];
    $texto = $_POST['texto'];
    $fecha = date("d/M/Y");
    $hora = date("H:i:s");
    $_SESSION['texto'][] = [
        'titulo' => $titulo,
        'texto' => $texto,
        'fecha' => $fecha,
        'hora' => $hora,
    ];
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
     <h5>Última nota creada:
        <?php 
        if(isset($_SESSION['texto']['titulo'])) {
        echo  ($_SESSION['texto'])['titulo'] ;
         }else {
             echo 'Ninguna'; 
             }?></h5>
             <br>
    

<table border="1">
<tr>
    <td>Titulo</td>
    <td>Fecha</td>
    <td>Hora</td>
</tr>
<?php
foreach ($_SESSION['texto'] as $i => $datos) {
    ?>
   <tr>
    <td><a href="?nota=<?= $i ?>"><?= $datos['titulo'] ?></a></td>
    <td><?= $datos['fecha'] ?></td>
    <td><?= $datos['hora'] ?></td>
    <?php if(isset($_GET['nota']) && $_GET['nota'] == $i){
        echo "<td colspan='$i'><h4>" . $datos['titulo'] . "</h4><br><br>" . $datos['texto'] . "</td>";
    }
    ?>
</tr>
<?php
}
?>

</table>
<br>
<br>

<form method="post">
    <label>TÍTULO</label>
    <input type="text" name="titulo" required>
    <br>
    <label>TEXTO</label>
    <input type="text" name="texto" required>
    <br>
    <input type="submit" name="add" value="Añadir" required>

</form>
    
</body>
</html>