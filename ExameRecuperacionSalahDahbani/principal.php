<?php
include 'libro.php';
if (session_status() == PHP_SESSION_NONE) session_start();
  if (!isset($_SESSION['user'])) {
      header("location: login.php");
      exit;
  }
$FICHERO_LIBROS = 'libros.txt';

if(!isset($_SESSION['texto'])){
    $_SESSION['texto']= [];
}

if(isset($_SESSION['user'])){
   $user = $_SESSION['user'];
}
$libros = cargar_libros($FICHERO_LIBROS);

function cargar_libros($fichero)
{
    // Carga los proyectos desde el fichero
    if (file_exists($fichero) && filesize($fichero) > 0) {
        $contenido = file_get_contents($fichero);
        $libros = serialize($contenido);
        if ($libros == [] || $libros !== false) {
            return $libros;
        } else {
            return [];
        }
    }
    return [];
}

function cargarLibros() {
    if (file_exists('libros.txt')) {
        $libros = [];
        $lineas = file('libros.txt', FILE_IGNORE_NEW_LINES);
        foreach ($lineas as $linea) {
            list($titulo, $estado, $fecha, $nombre) = explode(',', $linea);
            $libros[] = [
                'titulo' => $titulo,
                'estado' => $estado,
                'fecha' => $fecha,
                'nombre' => $nombre ,
            ];
        }
        return $libros;
    }
    return [];
}

function guardar_libros_texto($fichero, array $libros): void
{
    $contenido_texto = '';
    
    // Recorremos el array de objetos Proyecto
    foreach ($libros as $l_serializado) {
        $libro = unserialize($l_serializado); // Deserializamos el objeto de la sesión
        
        if ($libro instanceof libro) {
            // Obtenemos los datos, incluyendo la urgencia (que ya está actualizada)
            $linea = $libro->getTitulo() . ',' .
                     $libro->getEstado() . ',' . // <-- El estado actualizada
                     $libro->getFecha() . ',' . 
                     $libro->getNombre() . 
                     "\n";
            $contenido_texto .= $linea;
        }
    }
    
    // Guardamos la cadena de texto en el fichero
    file_put_contents($fichero, $contenido_texto);
}


// Inicializar la sesión con los datos del fichero si es la primera vez
if (!isset($_SESSION['libro'])) {
    $_SESSION['libro'] = [];
}
if (empty($_SESSION['libro'])) {
    $_SESSION['libro'] = cargarLibros($FICHERO_LIBROS);
}


if(isset($_REQUEST['prestar'])) {
    // Asignación simple
    $libro_a_prestar = "";
    if (isset($_REQUEST['titulo'])) {
        $libro_a_prestar = $_REQUEST['titulo'];
    }
    $nombre_usuario = $_SESSION['user'];
    $nuevo_esatdo = "";
    if (isset($_REQUEST['nuevo_estado'])) {
        $nuevo_esatdo = "prestado";
    }

    foreach ($_SESSION['libro'] as $key => $l_serializado) {
        $libro = unserialize($l_serializado);
        
        if ($libro->getTitulo() == $libro_a_prestar) {
            
            $libro->setEstado($nuevo_esatdo);
            $libro->setNombre($nombre_usuario);
            
            $_SESSION['libro'][$key] = serialize($libro);
            $mensaje_accion = "Estado del libro $libro_a_prestar prestado.";
            break; 
        }
    }
}

if(isset($_REQUEST['devolver'])) {
    // Asignación simple
    $libro_a_devolver = "";
    if (isset($_REQUEST['titulo'])) {
        $libro_a_devolver = $_REQUEST['titulo'];
    }
    $nombre_usuario = $_SESSION['user'];
    $nuevo_esatdo = "";
    if (isset($_REQUEST['nuevo_estado'])) {
        $nuevo_esatdo = "libre";
    }

    foreach ($_SESSION['libro'] as $key => $l_serializado) {
        $libro = unserialize($l_serializado);
        
        if ($libro->getTitulo() == $libro_a_devolver) {
            
            $libro->setEstado($nuevo_esatdo);
            $libro->setNombre($nombre_usuario);
            
            $_SESSION['libro'][$key] = serialize($libro);
            $mensaje_accion = "Estado del libro $libro_a_devolver libre.";
            break; 
        }
    }
}

if (isset($_REQUEST['prestar']) || isset($_REQUEST['devolver'])) {
    guardar_libros_texto($FICHERO_PROYECTOS, $_SESSION['libro']);
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

<h1>USUARIO:<?= $_SESSION['user']['user'] ?></h1>

<h2><a href="login.php">CERRAR SESIÓN</a></h2>
________________________________________________________________________________________________________________________________________________________________________________________

<br><br>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Titulo</th>
        <th>Estado</th>
        <th>Fecha</th>
        <th>Nombre</th>
    </tr>
    <?php
    foreach ($libros as $l_serializado) {
        $libro = unserialize($l_serializado);
        echo "<tr>";
        $color_desc = "";
        if ($libro->getFecha() == 'prestado') {
            
        echo "<td>" . $libro->getTitulo() . "</td>";
        echo "<td>" . $libro->getEstado() . "</td>";
        echo "<td></td>";
        echo "<td></td>";

        echo "<td>";
        echo "<form method='post' style='margin:0; display:flex; gap:5px; align-items:center;'>";
        echo "<input type='hidden' name='titulo' value='" . $libro->getTitulo() . "'>";
        echo "<input type='submit' name='prestar' value='Prestar'>"; 
        echo "</form>";
        echo "</td>";
        }else {
            $color_desc = "style='color: red; font-weight: bold;'";
            echo "<td $color_desc >" . $libro->getTitulo() . "</td>";
        echo "<td $color_desc>" . $libro->getEstado() . "</td>";
        echo "<td $color_desc >" . $libro->getFecha() . "</td>";
        echo "<td $color_desc>" . $libro->getNombre() . "</td>";

        echo "<td>";
        echo "<form method='post' style='margin:0; display:flex; gap:5px; align-items:center;'>";
        echo "<input type='hidden' name='titulo' value='" . $libro->getTitulo() . "'>";
        echo "<input type='submit' name='devolver' value='Devolver'>"; 
        echo "</form>";
        echo "</td>";
        }
        echo "</tr>";
    }
    ?>
</table>

<br><br>


    
</body>
</html>