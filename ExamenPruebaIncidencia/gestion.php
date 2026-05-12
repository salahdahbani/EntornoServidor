<?php
include 'Incidencia.php';
if (session_status() == PHP_SESSION_NONE) session_start();
$FICHERO_INCIDENCIAS = __DIR__ . '/incidencias.dat';
$ahora = time();
$expira = time() + 31536000; // 1 año

// --- CORRECCIÓN 1: Inicializar la variable del mensaje para evitar el error de "Undefined variable"
$mensaje_accion = ""; 

if (!isset($_SESSION['incidencia'])) {
    $_SESSION['incidencia'] = [];
}
if (empty($_SESSION['incidencia'])) {
    $_SESSION['incidencia'] = cargar_incidencias($FICHERO_INCIDENCIAS);
}

function cargar_incidencias($fichero)
{
    $incidencias_cargadas = [];
    if (file_exists($fichero) && filesize($fichero) > 0) {
        $lineas = file($fichero, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lineas as $linea) {
            $datos = explode(',', $linea);
            // IMPORTANTE: Ajusta estos índices según cómo guardes en guardar_incidencias_texto
            if (count($datos) >= 3) {
                $codigo = $datos[0];
                $descripcion = $datos[1];
                $prioridad = $datos[2];
                $estado = $datos[3] ?? 'ABIERTO';
                
                // Pasamos array vacío al final por si el constructor pide desarrolladores
                $nueva_i = new Incidencia($codigo, $descripcion, $prioridad, []);
                $nueva_i->setEstado($estado);

                $incidencias_cargadas[] = serialize($nueva_i);
            }
        }
    }
    return $incidencias_cargadas;
}

function guardar_incidencias_texto($fichero, array $incidencias_serializadas): void
{
    $contenido_texto = '';
    foreach ($incidencias_serializadas as $i_serializada) {
        $incidencia = unserialize($i_serializada);
        if ($incidencia instanceof Incidencia) {
            $linea = $incidencia->getMatricula() . "," . 
                     $incidencia->getDescripcion() . "," . 
                     $incidencia->getPrioridad() . "," . 
                     $incidencia->getEstado();
            $contenido_texto .= $linea . PHP_EOL;
        } else {
            // Esto te avisará si hay un problema con el objeto
            error_log("Error: El objeto no es una instancia de Incidencia");
        }
    }
    
    $resultado = file_put_contents($fichero, $contenido_texto);
    
    if ($resultado === false) {
        echo "<script>alert('ERROR: No se pudo escribir en el archivo. Revisa permisos.');</script>";
    } else {
        error_log("Se escribieron $resultado bytes en $fichero");
    }
}

if(isset($_REQUEST['cargar_fichero'])) {
    $_SESSION['incidencia'] = cargar_incidencias($FICHERO_INCIDENCIAS);
    $mensaje_accion = "Fichero cargado correctamente.";
}

if(isset($_REQUEST['guardar_fichero'])) {
    guardar_incidencias_texto($FICHERO_INCIDENCIAS, $_SESSION['incidencia']);
    $mensaje_accion = "Fichero actualizado correctamente.";
}

if(isset($_REQUEST['crear'])) { 
    $matricula = $_REQUEST['matricula'];
    $descripcion = $_REQUEST['descripcion'];
    $prioridad = $_REQUEST['nueva_prioridad'];
    $estado = $_REQUEST['estado'] ?? 'ABIERTO';

    $nueva = new Incidencia($matricula, $descripcion, $prioridad, []);
    $nueva->setEstado($estado);

    $_SESSION['incidencia'][] = serialize($nueva);
    $mensaje_accion = "Incidencia $matricula creada.";
    // Guardado automático
    guardar_incidencias_texto($FICHERO_INCIDENCIAS, $_SESSION['incidencia']);
}

if(isset($_REQUEST['cambiar_prioridad'])) {
    foreach ($_SESSION['incidencia'] as $key => $i_serializado) {
        $incidencia = unserialize($i_serializado);
        if ($incidencia->getMatricula() == $_REQUEST['matricula']) {
            $incidencia->setPrioridad($_REQUEST['nueva_prioridad']);
            $_SESSION['incidencia'][$key] = serialize($incidencia);
             
        }
    }
    guardar_incidencias_texto($FICHERO_INCIDENCIAS, $_SESSION['incidencia']);
}

if(isset($_REQUEST['cambiar_estado'])) {
    foreach ($_SESSION['incidencia'] as $key => $i_serializado) {
        $incidencia = unserialize($i_serializado);
        if ($incidencia->getMatricula() == $_REQUEST['matricula']) {
            $incidencia->setEstado($_REQUEST['estado']);
            $_SESSION['incidencia'][$key] = serialize($incidencia);
            
        }
    }
    guardar_incidencias_texto($FICHERO_INCIDENCIAS, $_SESSION['incidencia']);
}

// Estadísticas
Incidencia::$stats = ['URGENTE' => 0, 'NORMAL' => 0, 'BAJA' => 0]; 
// 2. Contar de nuevo recorriendo la sesión
foreach ($_SESSION['incidencia'] as $i_serializado) {
    $incidencia = unserialize($i_serializado);
    $prio = strtoupper($incidencia->getPrioridad()); // Forzamos mayúsculas para que coincida con las llaves
    if (isset(Incidencia::$stats[$prio])) {
        Incidencia::$stats[$prio]++;
    }
}

if (isset($_POST['logout'])) {
    // 1. Vaciamos el array de la sesión para que no haya datos en memoria
    $_SESSION['incidencia'] = [];
    
    // 2. Si lo que quieres es que al cerrar sesión se BORRE el fichero permanentemente:
    file_put_contents($FICHERO_INCIDENCIAS, ""); 
    
    // 3. Destruimos la sesión
    session_destroy();
    
    // 4. IMPORTANTE: Redirigir o recargar para que el script se detenga aquí
    header("Location: gestion.php"); 
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Proyectos</title>
</head>
<body>

<?php 
if ($mensaje_accion != '') {
    echo "<p style='color: green; font-weight: bold;'>$mensaje_accion</p>";
}
?>

<h2>Estadísticas de Prioridad:</h2>
<ul>
    <?php foreach (Incidencia::$stats as $prioridad_stat => $cantidad): ?>
        <li><?= $prioridad_stat ?>: **<?= $cantidad ?>** incidencias</li>
    <?php endforeach; ?>
</ul>

<hr>

<h2>Nueva Incidencia</h2>
<form method="post">
    Matrícula: <input type="text" name="matricula" required><br><br>
    Descripción: <input type="text" name="descripcion" required><br><br>
    Prioridad: 
    <select name='nueva_prioridad'>
        <?php
        $prioridades = ['URGENTE', 'NORMAL', 'BAJA'];
        foreach ($prioridades as $p) {
            // --- CORRECCIÓN 5: Comparamos contra un string fijo o quitamos el if para evitar el error de Array
            $selected = ($p == 'NORMAL') ? "selected" : "";
            echo "<option value='$p' $selected>$p</option>";
        }
        ?>
    </select>
    <br><br>
    Estado: 
    <select name='estado'>
        <?php
        $estados = ['ABIERTO', 'En proceso', 'RESUELTA'];
        foreach ($estados as $e) {
            $selected = ($e == 'ABIERTO') ? "selected" : "";
            echo "<option value='$e' $selected>$e</option>";
        }
        ?>
    </select>
    <br><br>
    <input type="submit" value="Crear Incidencia" name="crear">
</form>

<br><br>
_____________________________________________________________________________________________________
<h2>Listado de Proyectos</h2>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Matricula</th>
        <th>Descripción</th>
        <th>Estado</th>
        <th>Prioridad (Modificar)</th>
    </tr>
    <?php
    foreach ($_SESSION['incidencia'] as $i) {
        $incidencia = unserialize($i);
        echo "<tr>";
        echo "<td>" . $incidencia->getMatricula() . "</td>";

        $color_desc = ($incidencia->getPrioridad() == 'URGENTE') ? "style='color: red; font-weight: bold;'" : "";
        echo "<td $color_desc>" . $incidencia->getDescripcion() . "</td>";

        echo "<td>";
        echo "<form method='post' style='margin:0; display:flex; gap:5px; align-items:center;'>";
        echo "<input type='hidden' name='matricula' value='" . $incidencia->getMatricula() . "'>";
        echo "<select name='nueva_prioridad'>";
        foreach (['URGENTE', 'NORMAL', 'BAJA'] as $u) {
            $selected = ($u == $incidencia->getPrioridad()) ? "selected" : "";
            echo "<option value='$u' $selected>$u</option>";
        }
        echo "</select>";
        echo "<input type='submit' name='cambiar_prioridad' value='Cambiar_prioridad'>";
        echo "</td>";

        echo "<td>";
        echo "<select name='estado'>";
        foreach (['ABIERTO', 'En proceso', 'RESUELTA'] as $e) {
            $selected = ($e == $incidencia->getEstado()) ? "selected" : "";
            echo "<option value='$e' $selected>$e</option>";
        }
        echo "</select>";
        // --- CORRECCIÓN 6: El name debe coincidir con el if de arriba (cambiar_estado)
        echo "<input type='submit' name='cambiar_estado' value='Cambiar_estado'>"; 
        
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    ?>
</table>

<br><br>
<form method="post">
    <input type='submit' name='cargar_fichero' value='Cargar'>
    <input type='submit' name='guardar_fichero' value='Guardar'>
    <input type="submit" value="Cerrar sesión" name="logout">
</form>
</body>
</html>