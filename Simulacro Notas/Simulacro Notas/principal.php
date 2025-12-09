<?php
  include_once 'Nota.php';
  if (session_status() == PHP_SESSION_NONE) session_start();
  if (!isset($_SESSION['usuario'])) {
      header("location: index.php");
  } else if (!array_key_exists($_SESSION['usuario'], $_SESSION['notas'])) {
      $_SESSION['notas'][$_SESSION['usuario']] = [];
  } 

  if (isset($_REQUEST['añadir'])) {
    $_SESSION['notas'][$_SESSION['usuario']][] = serialize(new Nota($_REQUEST['titulo'], $_REQUEST['texto']));
  }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Panel de notas del usuario <?= $_SESSION['usuario'] ?></h1>
<?php
  echo "<b>Última nota creada: </b>".Nota::getUltima(). "<br>"; 
  echo "<b>Fecha: </b>".date("d/m/Y - H:i:s",Nota::getFecha()). "<br><br>"; 
?>

<table border="1">
<tr>
    <td>
        <table border="1">
            <tr><th>Titulo</th><th>fecha</th><th>hora</th></tr>
            <?php
  $i=0;
  foreach ($_SESSION['notas'][$_SESSION['usuario']] as $nota) {
    $nota=unserialize($nota);
    $fecha=date("d/m/Y", $nota->getCreacion());
    $hora=date("H:i:s", $nota->getCreacion());
    $titulo=$nota->getTitulo();
    echo "<tr><td><a href='principal.php?numNota=$i'>$titulo</td><td>$fecha</td><td>$hora</td></tr>";
    $i++;
  } 
?>
        </table>
    </td>
    <td>
<?php
  if (isset($_REQUEST['numNota'])) {
    $nota=unserialize($_SESSION['notas'][$_SESSION['usuario']][$_REQUEST['numNota']]);
    echo "<h3>". $nota->getTitulo(). "</h3>";
    echo nl2br($nota->getTexto());
  } 
?>
    </td>
</tr>
</table>
<h3>Añadir nota nueva</h3>
<form action="" method="post">
    TITULO: <input type="text" name="titulo"><br>
    TEXTO: <textarea name="texto" cols="50" rows="5"></textarea><br><br>
    <input type="submit" name="añadir" value="AÑADIR">
</form>
    
<br>
    <form action="index.php" method="post">
        <input type="submit" name="cerrar" value="CERRAR SESIÓN">
    </form>
</body>
</html>