<?php
require_once '../Model/Tipo.php';

// Obtener las especies para el desplegable
$listaTipos = Tipo::getTipos();

// Cargar la vista del formulario
require_once '../View/nuevaHabitacion.php';