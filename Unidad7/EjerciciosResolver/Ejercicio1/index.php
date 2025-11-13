<?php
session_start();

$paleta_fija = array('#FF5733','#33FF57','#3357FF','#FF33A8','#A833FF','#33FFF5','#F5FF33','#FF8F33','#8FFF33','#33FF8F');

if (!isset($_SESSION['colores'])) $_SESSION['colores'] = array();
if (!isset($_SESSION['indice_paleta'])) $_SESSION['indice_paleta'] = 0;
if (!isset($_SESSION['fondo'])) $_SESSION['fondo'] = '#FFFFFF';

if (isset($_POST['add_color'])) {
    $idx = $_SESSION['indice_paleta'];
    $color = $paleta_fija[$idx % count($paleta_fija)];
    $_SESSION['colores'][] = $color;
    $_SESSION['fondo'] = $color;
    $_SESSION['indice_paleta'] = ($idx + 1) % count($paleta_fija);
    header('Location: index.php');
    exit;
}

if (isset($_POST['destroy'])) {
    unset($_SESSION['colores']);
    unset($_SESSION['indice_paleta']);
    unset($_SESSION['fondo']);
    session_destroy();
    header('Location: index.php');
    exit;
}

$fondo = $_SESSION['fondo'];
$colores = $_SESSION['colores'];
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Paleta</title></head>
<body style="background-color: <?php echo $fondo; ?>;">
<form method="post">
<button name="add_color">Añadir color</button>
<button formaction="paleta.php" formmethod="get">Mostrar paleta creada</button>
<button name="destroy">Destruir paleta</button>
</form>

<p>Colores generados: <?php echo count($colores); ?></p>

<ul>
<?php foreach ($colores as $c) echo "<li>$c</li>"; ?>
</ul>
</body>
</html>
