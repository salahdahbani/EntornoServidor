<?php

require_once '../Model/Ciudad.php';
require_once '../Model/Transporte.php';

$ciudades = Ciudad::getCiudades();

$transportes = Transporte::getTransportes();

include '../View/index_view.php';
