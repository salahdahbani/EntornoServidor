<?php
include 'Receta.php';
if (session_status() == PHP_SESSION_NONE) session_start();

if(!isset($_SESSION['ficheros'])){
    $_SESSION['ficheros'] = [];
}
if(!isset($_SESSION['recetas'])){
    $_SESSION['recetas'] = [];
}
if(isset($_REQUEST['add_fichero']) && isset($_REQUEST['fichero'])) {
    $_SESSION['ficheros'][] = $_REQUEST['fichero'];
}
 $ingredientes = [];
if(isset($_REQUEST['add_ingrediente'])){
    $indice = $_REQUEST['receta_idx']; // Necesitamos saber cuál es
    $nuevo_ingre = $_REQUEST['ingre_nuevo'];

    if (isset($_SESSION['recetas'][$indice])) {
        // 1. Sacamos la receta de la sesión
        $receta = unserialize($_SESSION['recetas'][$indice]);
        
        // 2. Usamos el nuevo método que creamos en la clase
        $receta->addIngredienteExtra($nuevo_ingre);
        
        // 3. La volvemos a guardar serializada
        $_SESSION['recetas'][$indice] = serialize($receta);
    }
}

if(isset($_REQUEST['add'])) { 
    for ($i = 1; $i <= 5; $i++) {
        $campo = "ingrediente$i";
        if (!empty($_REQUEST[$campo])) {
            $ingredientes[] = $_REQUEST[$campo];
        }
    }

    
    // Asignación simple
    $nombre = $_REQUEST['nombre'];
    $codigo = date("dmyHis") . "-" . strtoupper(substr($nombre,-3, 3));
    $tipo = $_REQUEST['select_tipo'];
    
    $_SESSION['recetas'][] = serialize(new Receta($codigo, $nombre,  $tipo, $ingredientes));
    $mensaje_accion = "Proyecto $codigo creado.";
}

if (isset($_POST['confirmar'])) {
    // lista de ficheros permitidos (evita que pasen rutas arbitrarias)
    $ficheros_permitidos = $_SESSION['ficheros'] ?? [];

    $fichero_seleccionado = $_POST['fichero_elegido'] ?? '';

    if (!in_array($fichero_seleccionado, $ficheros_permitidos)) {
        $mensaje_accion = "Fichero no válido.";
    } else {
        // abrir en modo append
        $fp = fopen($fichero_seleccionado, 'a');
        if ($fp === false) {
            $mensaje_accion = "No se pudo abrir el fichero. Revisa permisos.";
        } else {
            // si no hay recetas, no hacemos nada
            if (!empty($_SESSION['recetas'])) {
                foreach ($_SESSION['recetas'] as $p) {
                    $receta = unserialize($p);
                    // crear la línea CSV; uso '|' para separar ingredientes por si contienen comas
                    $linea = $receta->getCodigo() . ',' .
                             $receta->getNombre() . ',' .
                             $receta->getTipo() . ',' .
                             implode('|', $receta->getIngredientes());
                    fwrite($fp, $linea . PHP_EOL);
                }
            }
            fclose($fp);
            $mensaje_accion = "Recetas guardadas en " . htmlspecialchars($fichero_seleccionado);
        }
    }
}

if(isset($_REQUEST['cargar_fichero']) && isset($_REQUEST['fichero_elegido'])) {
    $fichero_seleccionado = $_REQUEST['fichero_elegido'];
    if (file_exists($fichero_seleccionado)) {
        $lineas = file($fichero_seleccionado);
        foreach ($lineas as $linea) {
            list($codigo, $nombre, $tipo, $ingredientes_str) = explode(',', $linea);
            $ingredientes = explode('|', $ingredientes_str);
            $_SESSION['recetas'][] = serialize(new Receta($codigo, $nombre,  $tipo, $ingredientes));
        }
    ?>
</table>
        <?php
        $mensaje_accion = "Recetas cargadas desde " . $fichero_seleccionado;

    } else {
        $mensaje_accion = "Fichero no encontrado.";
    }

}

if(isset($_POST['empezar_nuevo'])){
    session_destroy();
    header("Location: index.php");
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

<h1>MIS RECETAS</h1>
<form method="post">
    Cargar Fichero:
    <select name="fichero_elegido">
        <?php
        if(isset($_SESSION['ficheros'])){
        foreach ($_SESSION['ficheros'] as $valor) {
            ?>
            <option value="<?= $valor ?>"?><?=$valor?></option>
            <?php
        }
        }
        ?>
    </select>
        <input type="submit" name="confirmar" value="OK">
        <input type="text" name="fichero" placeholder="Nuevo fichero...">
        <input type="submit" name="add_fichero" value="AÑADIR FICHERO">
        <input type="submit" name="cargar_fichero" value="CARGAR RECETAS">
    </form>
   
    <form method="post">
    <input type="submit" name="empezar_nuevo" value="EMPEZAR NUEVO">

</form>
<br><br><br>

<form method="post">
    Nombre:
    <input type="text" name="nombre" required>
    Tipo:
    <select name="select_tipo">
        <?php
        $tipo =[ "entrante", "principal" , "postre"];
        foreach ($tipo as $u) {
            ?>

            <option value="<?= $u ?>" name="tipo"><?= $u ?></option>
            <?php
        }
        ?>


    </select> 
    <br>
    Ingredientes básicos:
    <br>
    Sal
    <input type="checkbox" name="ingrediente1" value="Sal">
    <br>
    Aceite
    <input type="checkbox" name="ingrediente2" value="Aceite">
    <br>
    Ajo
    <input type="checkbox" name="ingrediente3" value="Ajo">
    <br>
    Pimiento
    <input type="checkbox" name="ingrediente4" value="Pimiento">
    <br>
    Tomate
    <input type="checkbox" name="ingrediente5" value="Tomate">
    <br><br>
    <input type="submit" name="add" value="AÑADIR">
</form>
<br><br>
<form method="post">
    <input type="submit" name="logout" value="cerrar">
   
</form>
________________________________________________________________________________________________________________________________________________________________________________________

<br><br>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Código</th>
        <th>Nombre</th>
        <th>Tipo</th>
        <th>Ingredientes</th>
    </tr>
    <?php
    // Cambia tu foreach por este:
foreach ($_SESSION['recetas'] as $key => $p) {
    $receta = unserialize($p);
    echo "<tr>";
    echo "<td>" . $receta->getCodigo() . "</td>";
    echo "<td>" . $receta->getNombre() . "</td>";
    echo "<td>" . $receta->getTipo() . "</td>";
    echo "<td>" . implode("<br>-", $receta->getIngredientes()) . "</td>";
    echo "<td>";
    echo "<form method='post' style='margin:0; display:flex; gap:5px;'>";
    
    // CAMBIO IMPORTANTE: Enviamos la posición de la receta en el array
    echo "<input type='hidden' name='receta_idx' value='$key'>";
    
    echo "<input type='text' name='ingre_nuevo' placeholder='Nuevo...'>";
    echo "<input type='submit' name='add_ingrediente' value='AÑADIR'>"; 
    echo "</form>";
    echo "</td>";
    echo "</tr>";

    }
    ?>
</table>

<br><br>


    
</body>
</html>