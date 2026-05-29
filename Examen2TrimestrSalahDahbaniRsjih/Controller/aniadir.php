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

<<<<<<< HEAD
=======
    $fechaHoy=date("Y-m-d");
    if($transporte->getOrigen() == $transporte->getDestino()) {
        header("Location: index.php?error=El+origen+y+destino+no+pueden+ser+iguales");
        exit();
    }

    
    if($fechaHoy > $transporte->getFecha()) {
        header("Location: index.php?error2=La+fecha+no+puede+ser+inferior+a+la+de+hoy");
        exit();
    }

>>>>>>> 707a7ae7bef1b796aa734c9b85d8b190f3e971c3
    $transporte->insert();

}

header("Location: index.php?mensaje=Transporte añadido correctamente");


