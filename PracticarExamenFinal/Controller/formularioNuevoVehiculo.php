<?php
require_once '../Model/Categoria.php';
// Obtener las especies para el desplegable
$listaCategorias = Categoria::getCategorias();

// Cargar la vista del formulario
require_once '../View/nuevoVehiculo.php';