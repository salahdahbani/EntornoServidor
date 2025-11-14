<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de CVs</title>
</head>
<body>

<?php
if (isset($_REQUEST['cvs']) && $_REQUEST['cvs'] !== '') {
    $cvs = @unserialize(base64_decode($_REQUEST['cvs']));
    if ($cvs === false) $cvs = array();
} else {
    $cvs = array();
}

// ver si estamos creando un CV nuevo
$crearCV = isset($_REQUEST['nuevo_dni']);
$agregarCampo = isset($_REQUEST['add_campo']);
$verCV = isset($_REQUEST['ver_dni']);
$dniActual = isset($_REQUEST['dni_actual']) ? $_REQUEST['dni_actual'] : '';

$cvs_ser = base64_encode(serialize($cvs));
?>

<h2>Gestión de Curriculums</h2>

<?php if ($crearCV && !$agregarCampo){ ?>
    <h3>Nuevo CV: <?php echo $_REQUEST['nuevo_dni']; ?></h3>
    <form method="post">
        <input type="hidden" name="cvs" value="<?php echo $cvs_ser; ?>">
        <input type="hidden" name="dni_actual" value="<?php echo $_REQUEST['nuevo_dni']; ?>">
        Título: <input name="titulo"><br>
        Valor: <input name="valor"><br>
        <button name="add_campo">Añadir campo</button>
        <button name="finalizar">Finalizar</button>
    </form>
<?php }elseif ($agregarCampo){ ?>
    <?php
    $titulo = isset($_REQUEST['titulo']) ? $_REQUEST['titulo'] : '';
    $valor = isset($_REQUEST['valor']) ? $_REQUEST['valor'] : '';
    if (!isset($cvs[$dniActual])) $cvs[$dniActual] = array();
    if ($titulo !== '') $cvs[$dniActual][$titulo] = $valor;
    $cvs_ser = base64_encode(serialize($cvs));
    ?>
    <h3>Nuevo CV: <?php echo $dniActual; ?></h3>
    <form method="post">
        <input type="hidden" name="cvs" value="<?php echo $cvs_ser; ?>">
        <input type="hidden" name="dni_actual" value="<?php echo $dniActual; ?>">
        Título: <input name="titulo"><br>
        Valor: <input name="valor"><br>
        <button name="add_campo">Añadir campo</button>
        <button name="finalizar">Finalizar</button>
    </form>
<?php }elseif (isset($_REQUEST['finalizar'])){ ?>
    <p>CV guardado para DNI: <?php echo $dniActual; ?></p>
    <form method="post">
        <input type="hidden" name="cvs" value="<?php echo $cvs_ser; ?>">
        <button name="volver">Volver a la página principal</button>
    </form>
<?php }elseif ($verCV){ ?>
    <h3>CV de DNI: <?php echo $verCV; ?></h3>
    <?php if (isset($cvs[$verCV])){ ?>
        <table border="1">
            <?php foreach ($cvs[$verCV] as $t => $v){ ?>
            <tr><td><?php echo $t; ?></td><td><?php echo $v; ?></td></tr>
            <?php } ?>
        </table>
    <?php }else{ ?>
        <p>No existe CV para este DNI.</p>
    <?php } ?>
    <form method="post">
        <input type="hidden" name="cvs" value="<?php echo $cvs_ser; ?>">
        <button name="volver">Volver al listado</button>
    </form>
<?php }else{?>
    <h3>Página principal</h3>
    <form method="post">
        DNI: <input name="nuevo_dni"><br>
        <input type="hidden" name="cvs" value="<?php echo $cvs_ser; ?>">
        <button name="nuevo_dni_btn">Nuevo CV</button>
    </form>

    <h3>Listado de CVs</h3>
    <?php if (count($cvs) === 0){ ?>
        <p>No hay CVs introducidos.</p>
    <?php }else {?>
        <ul>
            <?php foreach ($cvs as $dni => $cv) { ?>
                <li>
                    <form method="post" style="display:inline">
                        <input type="hidden" name="cvs" value="<?php echo $cvs_ser; ?>">
                        <button name="ver_dni" value="<?php echo $dni; ?>"><?php echo $dni; ?></button>
                    </form>
                </li>
            <?php } ?>
        </ul>
    <?php } ?>
<?php } ?>

</body>
</html>
