<?php
require_once '../Model/Especie.php';

// Obtener las especies para el desplegable
$listaEspecies = Especie::getEspecies();

// Cargar la vista del formulario
require_once '../View/nuevoAnimal.php';