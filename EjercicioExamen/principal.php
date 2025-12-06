<?php
if(session_status() == PHP_SESSION_NONE) session_start();


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
if(isset($_POST['entrar'])){
$user = $_POST['user'];
$_SESSION['user']=[
    'user'=> $user,
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

      <?php 
    if(isset($_POST['logout'])){
        session_destroy();
        header("Location: login.php");
    exit();

    }
       ?>
    

   <h4>Añadir nota nueva</h4>

    <form method="post">
        <label>TÍTULO</label>
        <input type="text" name="titulo">
        <br>
        <br>
        <label>TEXTO</label>
        <input type="text" name="texto" size="100">
        <br>
        <br>
        <input type="submit" name="add" value="Añadir">
        <br>
        <br>
        <input type="submit" name="logout" value="Cerrar sesión">
    </form>

    <br>
    <a href="login.php">Volver al login</a>

</body>
</html>