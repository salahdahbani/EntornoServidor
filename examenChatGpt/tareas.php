<?php
  include_once 'Tarea.php';
  if (session_status() == PHP_SESSION_NONE) session_start();
 if (!isset($_SESSION['usuario'])) {
    header("location: login.php");
} else if (!isset($_SESSION['tarea']) || !array_key_exists($_SESSION['usuario'], $_SESSION['tarea'])) {
    $_SESSION['tarea'][$_SESSION['usuario']] = [];
}


  if (isset($_REQUEST['añadir'])) {
$_SESSION['tarea'][$_SESSION['usuario']][] = serialize(
    new Tarea(count($_SESSION['tarea'][$_SESSION['usuario']]), $_REQUEST['titulo'], $_REQUEST['descripcion'], $_REQUEST['categoria'], $_REQUEST['prioridad'])
);
  }

  function ordenar($tarea, $prioridad)
{
    if ($prioridad == 'asc') {
        usort($tarea, function ($a, $b) {
            $tareaA = unserialize($a);
            $tareaB = unserialize($b);
            return $tareaA->getPrioridad() <=> $tareaB->getPrioridad();
        });
    } else {
        usort($tarea, function ($a, $b) {
            $tareaA = unserialize($a);
            $tareaB = unserialize($b);
            return $tareaB->getPrioridad() <=> $tareaA->getPrioridad();
        });
    }
    return $tarea;
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
  echo "<b>Última nota creada: </b>".Tarea::getUltimaTarea(). "<br>"; 
  echo "<b>Fecha: </b>".date("d/m/Y - H:i:s",Tarea::getFechaTarea()). "<br><br>"; 
?>

<table border="1">
<tr>
    <td>
        <table border="1">
            <tr><th>Titulo</th><th>fecha</th><th>hora</th><th>categoria</th><th>prioridad</th></tr>
            <?php
  $i=0;
  foreach ($_SESSION['tarea'][$_SESSION['usuario']] as $tarea) {
    $tarea=unserialize($tarea);
    $fecha=date("d/m/Y", $tarea->getCreacion());
    $hora=date("H:i:s", $tarea->getCreacion());
    $titulo=$tarea->getTitulo();
    $description=$tarea->getDescripcion();
    $categoria=$tarea->getCategoria();
    $prioridad=$tarea->getPrioridad();
    echo "<tr><td><a href='tareas.php?numTarea=$i'>$titulo</td><td>$fecha</td><td>$hora</td><td>$categoria</td><td>$prioridad</td></tr>";
    $i++;
  } 
?>
        </table>
    </td>
    <td>
<?php
  if (isset($_REQUEST['numTarea'])) {
    $tarea=unserialize($_SESSION['tarea'][$_SESSION['usuario']][$_REQUEST['numTarea']]);
    echo "<h3>". $tarea->getTitulo(). "</h3>";
    echo nl2br($tarea->getDescripcion());
  } 
?>
    </td>
</tr>
</table>
<?php
  if (isset($_REQUEST['ordenarAsc'])) {
    $_SESSION['tarea'][$_SESSION['usuario']] = ordenar($_SESSION['tarea'][$_SESSION['usuario']], 'asc');
  }
?>
<h3>Añadir nota nueva</h3>
<form action="" method="post">
    TITULO: <input type="text" name="titulo"><br>
    DESCRIPCION: <textarea name="descripcion" cols="50" rows="5"></textarea><br><br>
    CATEGORIA: <select name="categoria">
        <option value="Trabajo">Trabajo</option>
        <option value="Personal">Personal</option>
        <option value="Estudios">Estudios</option>
    </select><br><br>
    PRIORIDAD: <input type="number" name="prioridad" min="1" max="5"><br><br>
    <input type="submit" name="añadir" value="AÑADIR">
    <input type="submit" name="ordenarAsc" value="ORDENAR">
</form>
    
<br>
    <form action="login.php" method="post">
        <input type="submit" name="cerrar" value="CERRAR SESIÓN">
    </form>
</body>
</html>