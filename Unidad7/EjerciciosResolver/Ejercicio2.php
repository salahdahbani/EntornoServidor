<?php
session_start();

$duracion = 90*24*60*60;

if (!isset($_SESSION['votos'])) {
    if (isset($_COOKIE['encuesta_votos'])) {
        $v = @unserialize($_COOKIE['encuesta_votos']);
        if (is_array($v)) $_SESSION['votos'] = $v;
        else $_SESSION['votos'] = array('si'=>0,'no'=>0);
    } else {
        $_SESSION['votos'] = array('si'=>0,'no'=>0);
    }
}

if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['voto'])) {
    $voto = $_POST['voto']=='si' ? 'si' : 'no';
    $_SESSION['votos'][$voto]++;
    setcookie('encuesta_votos', serialize($_SESSION['votos']), time()+$duracion);
    header('Location: encuesta.php');
    exit;
}

$votos = $_SESSION['votos'];
$total = $votos['si'] + $votos['no'];
$porc_si = $total>0 ? round(100*$votos['si']/$total) : 0;
$porc_no = $total>0 ? round(100*$votos['no']/$total) : 0;
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Encuesta</title></head>
<body>
<form method="post">
<button name="voto" value="si">Sí</button>
<button name="voto" value="no">No</button>
</form>

<p>Total votos: <?php echo $total; ?></p>

<div style="width:300px;border:1px solid #000;">
<div style="width:<?php echo $porc_si; ?>%;height:20px;"></div>
</div>
<p>Sí: <?php echo $votos['si']; ?> (<?php echo $porc_si; ?>%)</p>

<div style="width:300px;border:1px solid #000;">
<div style="width:<?php echo $porc_no; ?>%;height:20px;"></div>
</div>
<p>No: <?php echo $votos['no']; ?> (<?php echo $porc_no; ?>%)</p>
</body>
</html>
