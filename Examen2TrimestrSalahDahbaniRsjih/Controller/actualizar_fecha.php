<?php

require_once '../Model/Transporte.php';

if (
    isset($_POST['id']) &&
    isset($_POST['fecha'])
)
{

    $transporte = Transporte::getTransporteById($_POST['id']);

    if ($transporte)
    {
        $transporte->setFecha($_POST['fecha']);

        $transporte->update();
    }

}

header("Location: index.php?mensaje=Fecha actualizada correctamente");


