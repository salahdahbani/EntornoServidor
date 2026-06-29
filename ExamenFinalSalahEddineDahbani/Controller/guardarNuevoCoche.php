<?php
if(session_status() == PHP_SESSION_NONE) session_start();

require_once '../Model/Coche.php';


if (!empty($_POST['concesionario']) && isset($_POST['modelo']) && isset($_POST['unidades'])) {
    $unidades = $_POST['unidades'];
    $modelo = $_POST['modelo'];
    $cocheActual = Coche::getCocheByModelo($modelo);
    if ($cocheActual) {
        $nuevaCantidadTotal = $cocheActual->getunidades() + $unidades;

        // 3. Reutilizamos el método update pasándole la cantidad total calculada y su comida original
        $cocheActualizado = new Coche($cocheActual->getid(), $cocheActual->getmodelo(), $nuevaCantidadTotal, $cocheActual->getconcesionario());
        $cocheActualizado->update();
    }else {
    $nuevoCoche = new Coche(0, $_POST['modelo'],$_POST['unidades'], $_POST['concesionario']);
    $nuevoCoche->insert();

    $_SESSION['ultima_accion'] = "Registrado nuevo coche (" . $_POST['modelo'] . ") en " . $_POST['concesionario'] . " ";
}
}

// Redirección al controlador frontal para refrescar la lista
header('Location: index.php?action=listar');
exit;