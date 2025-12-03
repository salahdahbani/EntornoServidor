<?php
if(session_status() == PHP_SESSION_NONE) session_start();
//Inicializamos la sesion
if(!isset($_SESSION['user'])){
    $_SESSION['user']=[]; 
}

if(!isset($_SESSION['contenido'])){
    $_SESSION['contenido'][]=[]; 
}

if(isset($_POST['add'])){
$titulo = $_POST['titulo'];
$texto = $_POST['texto'];
$fecha = date("d/m/Y");
$hora = date("H:i:s");

$_SESSION['contenido'][]=[
        'titulo'=> $titulo,
        'texto' => $texto,
        'fecha'  => $fecha,
        'hora'  => $hora
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
    <h1>Panel de notas del usuario <?php echo isset($_SESSION['user']['user']) ? $_SESSION['user']['user'] : ''; ?></h1>

    <h5>Última nota creada:<?php echo !empty($_SESSION['contenido']) ? end($_SESSION['contenido'])['titulo'] : 'Ninguna'; ?></h5>


     <table border="1">
        <tr>
            <td>Título</td>
            <td>Fecha</td>
            <td>Hora</td>
            <td>Texto</td>
            

        </tr>
        
        <?php
        foreach($_SESSION['contenido'] as $nota){   
            echo "<tr>";
            echo "<td>" . $nota['titulo'] . "</td>";
            echo "<td>" . $nota['fecha'] . "</td>";
            echo "<td>" . $nota['hora'] . "</td>";
             echo "<td>" . $nota['texto'] . "</td>";
            echo "</tr>";
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

</body>
</html>