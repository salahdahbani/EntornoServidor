<?php
session_start();

if (isset($_GET['color'])) {
    $_SESSION['fondo'] = $_GET['color'];
    header('Location: paleta.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD']==='POST') {
    if (isset($_POST['volver'])) {
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
}

$colores = isset($_SESSION['colores']) ? $_SESSION['colores'] : array();
$fondo = isset($_SESSION['fondo']) ? $_SESSION['fondo'] : '#FFFFFF';
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Paleta</title></head>
<body style="background-color: <?php echo $fondo; ?>;">
<?php if (empty($colores)): ?>
<p>No hay colores. <a href="index.php">Volver</a></p>
<?php else: ?>
<table cellpadding="5" cellspacing="5">
<?php
$i = 0;
foreach ($colores as $color) {
    if ($i % 5 == 0) echo "<tr>";
    echo "<td><a href='paleta.php?color=$color'>
    <div style='width:80px;height:40px;border:1px solid #000;background-color:$color;'></div>
    <div>$color</div></a></td>";
    $i++;
    if ($i % 5 == 0) echo "</tr>";
}
if ($i % 5 != 0) echo "</tr>";
?>
</table>
<?php endif; ?>

<form method="post">
<button name="volver">Volver</button>
<button name="destroy">Destruir paleta</button>
</form>
</body>
</html>
