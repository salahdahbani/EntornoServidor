<?php
include 'Proyecto.php';
if (session_status() == PHP_SESSION_NONE) session_start();
$FICHERO_PROYECTOS = 'proyectos.txt';
$ahora = time();
$expira = time() + 31536000; // 1 año

// --- Funciones de Persistencia en Fichero (Sencillas) ---

function cargar_proyectos($fichero)
{
    $proyectos_cargados = [];
    if (file_exists($fichero) && filesize($fichero) > 0) {
        $lineas = file($fichero, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lineas as $linea) {
            $datos = explode(',', $linea);
            // El formato es: codigo, descripcion, urgencia, dev1, dev2...
            $codigo = $datos[0];
            $descripcion = $datos[1];
            $urgencia = $datos[2];
            // El resto son desarrolladores
            $desarrolladores = array_slice($datos, 3);
            
            // Creamos el objeto y lo guardamos SERIALIZADO en el array (como pide tu código)
            $nuevo_p = new Proyecto($codigo, $descripcion, $urgencia, $desarrolladores);
            $proyectos_cargados[] = serialize($nuevo_p);
        }
    }
    return $proyectos_cargados;
}

function guardar_proyectos_texto($fichero, array $proyectos_serializados): void
{
    $contenido_texto = '';
    foreach ($proyectos_serializados as $p_serializado) {
        $proyecto = unserialize($p_serializado);
        
        if ($proyecto instanceof Proyecto) {
            // Unimos los datos básicos + los desarrolladores en una sola línea
            $datos_base = [
                $proyecto->getCodigo(),
                $proyecto->getDescripcion(),
                $proyecto->getUrgencia()
            ];
            $linea = implode(',', array_merge($datos_base, $proyecto->getDesarrolladores()));
            $contenido_texto .= $linea . "\n";
        }
    }
    file_put_contents($fichero, $contenido_texto);
}
// Inicializar la sesión con los datos del fichero si es la primera vez
if (!isset($_SESSION['proyecto'])) {
    $_SESSION['proyecto'] = [];
}
if (empty($_SESSION['proyecto'])) {
    $_SESSION['proyecto'] = cargar_proyectos($FICHERO_PROYECTOS);
}
// ------------------------------------------------------------------

// --- Lógica de Cookies SIN ?? y SIN TERNARIOS ---
$total = 0;
if (isset($_COOKIE['t_total'])) {
    $total = (int)$_COOKIE['t_total'];
}
$ultimo = $ahora;
if (isset($_COOKIE['t_ultimo'])) {
    $ultimo = (int)$_COOKIE['t_ultimo'];
}

$total = $total + $ahora - $ultimo;

setcookie('t_ultimo', $ahora, $expira, "/");
setcookie('t_total', $total, $expira, "/");

// Cálculo de tiempo (uso floor para obtener el entero de días/horas/minutos)
$d = floor($total / 86400); 
$h = floor(($total % 86400) / 3600);
$m = floor(($total % 3600) / 60);

$mensaje_accion = '';

// --- Lógica de Creación de Proyecto ---
if(isset($_REQUEST['crear'])) {
    $desarrolladores = [];
    for ($i = 1; $i <= 5; $i++) {
        $campo = "desarrollador$i";
        if (!empty($_REQUEST[$campo])) {
            $desarrolladores[] = $_REQUEST[$campo];
        }
    }
    
    // Asignación simple
    $urgencia = $_REQUEST['urgencia'];
    $codigo = strtoupper(substr($urgencia,0, 2)) . rand(100, 999);
    $descripcion = $_REQUEST['descripcion'];
    
    $_SESSION['proyecto'][] = serialize(new Proyecto($codigo, $descripcion, $urgencia, $desarrolladores));
    $mensaje_accion = "Proyecto $codigo creado.";
}

// --- Lógica de Modificación de Prioridad ---
if(isset($_REQUEST['cambiar'])) {
    // Asignación simple
    $codigo_a_cambiar = "";
    if (isset($_REQUEST['codigo'])) {
        $codigo_a_cambiar = $_REQUEST['codigo'];
    }
    
    $nueva_prioridad = "";
    if (isset($_REQUEST['nueva_prioridad'])) {
        $nueva_prioridad = $_REQUEST['nueva_prioridad'];
    }

    foreach ($_SESSION['proyecto'] as $key => $p_serializado) {
        $proyecto = unserialize($p_serializado);
        
        if ($proyecto->getCodigo() == $codigo_a_cambiar) {
            
            $proyecto->setUrgencia($nueva_prioridad);
            
            $_SESSION['proyecto'][$key] = serialize($proyecto);
            $mensaje_accion = "Prioridad del proyecto $codigo_a_cambiar cambiada a $nueva_prioridad.";
            break; 
        }
    }
}

// --- Recalcular Estadísticas Estáticas ---
Proyecto::resetStats();
foreach ($_SESSION['proyecto'] as $p_serializado) {
    $proyecto = unserialize($p_serializado);
    $urgencia = $proyecto->getUrgencia();
    if (isset(Proyecto::$stats[$urgencia])) {
        Proyecto::$stats[$urgencia]++;
    }
}

// --- Lógica de Cierre de Sesión y Guardado ---
if (isset($_POST['logout'])){
    guardar_proyectos_texto($FICHERO_PROYECTOS, $_SESSION['proyecto']); // Guarda antes de cerrar
    session_destroy();
    setcookie('t_ultimo', '', time() - 3600); 
    setcookie('t_total', '', time() - 3600);
}

// --- Guardado tras cualquier acción (Crear/Cambiar) ---
if (isset($_REQUEST['crear']) || isset($_REQUEST['cambiar'])) {
    guardar_proyectos_texto($FICHERO_PROYECTOS, $_SESSION['proyecto']);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Proyectos</title>
</head>
<body>

<?php 
if ($mensaje_accion != '') {
    echo "<p style='color: green; font-weight: bold;'>$mensaje_accion</p>";
}
?>

<h2>Tiempo total en la web: <?php echo "$d días, $h horas, $m minutos"; ?></h2>

<h2>Estadísticas de Urgencia:</h2>
<ul>
    <?php foreach (Proyecto::$stats as $urgencia => $cantidad): ?>
        <li><?= $urgencia ?>: **<?= $cantidad ?>** proyectos</li>
    <?php endforeach; ?>
</ul>

<hr>

<h2>Nuevo Proyecto</h2>
<form method="post">
    Descripción: <input type="text" name="descripcion" required><br><br>
    Urgencia: 
    <input name="urgencia" type="radio" value="Crítica">Crítica
    <input name="urgencia" type="radio" value="Alta" checked>Alta
    <input name="urgencia" type="radio" value="Media">Media
    <input name="urgencia" type="radio" value="Baja">Baja
    <br>

    <br>
    Desarrollador 1: <input type="text" name="desarrollador1" required><br><br>
    Desarrollador 2: <input type="text" name="desarrollador2"><br><br>
    Desarrollador 3: <input type="text" name="desarrollador3"><br><br>
    Desarrollador 4: <input type="text" name="desarrollador4"><br><br>
    Desarrollador 5: <input type="text" name="desarrollador5"><br><br>
    <input type="submit" value="Crear Proyecto" name="crear">
</form>

<br><br>
________________________________________________________________________________________________________________________________________________________________________________________
<h2>Listado de Proyectos</h2>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Código</th>
        <th>Descripción</th>
        <th>Prioridad (Modificar)</th>
        <th>Desarrolladores</th>
    </tr>
    <?php
    foreach ($_SESSION['proyecto'] as $p) {
        $proyecto = unserialize($p);
        echo "<tr>";

        // Código
        echo "<td>" . $proyecto->getCodigo() . "</td>";

        // Descripción con color si es Crítica (¡Simplificado!)
        $color_desc = "";
        if ($proyecto->getUrgencia() == 'Crítica') {
            $color_desc = "style='color: red; font-weight: bold;'";
        }
        echo "<td $color_desc>" . $proyecto->getDescripcion() . "</td>";

        // Prioridad con select y botón Cambiar
        echo "<td>";
        echo "<form method='post' style='margin:0; display:flex; gap:5px; align-items:center;'>";
        echo "<select name='nueva_prioridad'>";
        $urgencias = ['Crítica', 'Alta', 'Media', 'Baja'];
        foreach ($urgencias as $u) {
            $selected = "";
            if ($u == $proyecto->getUrgencia()) { // ¡Simplificado!
                $selected = "selected";
            }
            echo "<option value='$u' $selected>$u</option>";
        }
        echo "</select>";
        echo "<input type='hidden' name='codigo' value='" . $proyecto->getCodigo() . "'>";
        echo "<input type='submit' name='cambiar' value='Cambiar'>"; 
        echo "</form>";
        echo "</td>";

        // Desarrolladores
        echo "<td>" . implode(", ", $proyecto->getDesarrolladores()) . "</td>";

        echo "</tr>";
    }
    ?>
</table>

<br><br>
<form method="post">
    <input type="submit" value="Cerrar sesión" name="logout">
</form>
</body>
</html>