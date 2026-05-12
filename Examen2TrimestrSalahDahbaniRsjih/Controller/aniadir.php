<?php

require_once '../Model/Transporte.php';

if (
    isset($_POST['origen']) &&
    isset($_POST['destino']) &&
    isset($_POST['fecha']) &&
    isset($_POST['empresa'])
)
{

    $transporte = new Transporte(
        0,
        $_POST['origen'],
        $_POST['destino'],
        $_POST['fecha'],
        $_POST['empresa']
    );

    $transporte->insert();

}

header("Location: index.php?mensaje=Transporte añadido correctamente");


