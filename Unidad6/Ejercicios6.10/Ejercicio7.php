<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 7 </title>
</head>
<body>
<h2>Edad en una fecha futura</h2>
<form method="post">
    Fecha de nacimiento: <input type="date" name="nacimiento"><br><br>
    Fecha futura: <input type="date" name="futura"><br><br>
    <input type="submit" value="Calcular edad">
</form>

<?php
if (isset($_POST['nacimiento'])) {
    $nacimiento = $_POST['nacimiento'];
    $futura = $_POST['futura'];

    list($anioN, $mesN, $diaN) = explode("-", $nac);
    list($anioF, $mesF, $diaF) = explode("-", $fut);

    if (checkdate($mesN, $diaN, $anioN) && checkdate($mesF, $diaF, $anioF)) {
        $seg_nac = strtotime($nacimiento);
        $seg_fut = strtotime($futura);

        if ($seg_fut > $seg_nac) {
            $edad = ($seg_fut - $seg_nac) / (60 * 60 * 24 * 365.25);
            $edad_entera = (int)$edad;
            echo "Tendrás aproximadamente <b>$edad_entera años</b> en esa fecha.";
        } else {
            echo "La fecha futura debe ser posterior a la de nacimiento.";
        }
    } else {
        echo "Alguna fecha no es válida.";
    }
}
?>
</body>
</html>
