<?php
require_once '../Model/Transporte.php';
require_once '../Model/Ciudad.php';

$metodo = $_SERVER['REQUEST_METHOD'];
$codEstado = 200;
$mensaje = 'OK';
$devolver = []; 

if ($metodo == 'GET') {
    if (isset($_REQUEST['fecha_inicio']) && isset($_REQUEST['fecha_fin'])) {
        $fecha_inicio = $_REQUEST['fecha_inicio'];
        $fecha_fin = $_REQUEST['fecha_fin'];

        if ($fecha_inicio > $fecha_fin) {
            $mensaje = "No existen transportes";
            $codEstado = 404;
        } else {
            $trans = Transporte::getTransportes(
                $_REQUEST['origen'] ,
                $_REQUEST['destino'] ,
                $_REQUEST['empresa'] ,
                null 
            );

            if (!$trans) {
                $mensaje = "No existe un viaje o transporte con las fechas aportadas";
                $codEstado = 404;
            } else {
                foreach ($trans as $t) {
                    $devolver[] = [
                        'origen' => $t->getOrigen(),
                        'destino' => $t->getDestino(),
                        'fecha' => $t->getFecha(),
                        'empresa' => $t->getEmpresa()
                    ];
                }
            }
        }
    } else {
        $mensaje = "Faltan fechas";
        $codEstado = 400;
    }
} else if ($metodo == 'DELETE') {
    parse_str(file_get_contents("php://input"), $parametros);

    if (!isset($parametros['nombre'])) {
        $mensaje = "Falta nombre de ciudad";
        $codEstado = 400;
    } else {
        $ciudad = Ciudad::getCiudadByNombre($parametros['nombre']);

        if ($ciudad) {
            $transportes_ciudad = Transporte::getTransportes($ciudad->getId(), null, null, null);
            if (!empty($transportes_ciudad)) {
                $mensaje = "CONTIENE UN TRANSPORTE";
                $codEstado = 404;
            } else {
                $ciudad->delete();
                $mensaje = "CIUDAD BORRADA";
            }
        } else {
            $mensaje = "CIUDAD NO ENCONTRADA";
            $codEstado = 404;
        }
    }
}

setCabecera($codEstado, $mensaje);
if ($metodo == 'GET' && $codEstado == 200) {
    echo json_encode($devolver);
}

function setCabecera($codEstado, $mensaje) {
    header("HTTP/1.1 $codEstado $mensaje");
    header("Content-Type: application/json;charset=utf-8");
}
