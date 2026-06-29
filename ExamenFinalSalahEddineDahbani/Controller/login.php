<?php
$archivo = "../Model/concesionarios.txt" ;
if(session_status() == PHP_SESSION_NONE) session_start();
//Inicializamos la sesion
if(!isset($_SESSION['concesionario'])){
    $_SESSION['concesionario']=[]; 
}

    

if(isset($_POST['entrar'])){
$concesionario = $_POST['concesionario'];
$datos = "$concesionario";
$_SESSION['concesionario']=[
    'concesionario'=> $concesionario
];
 
    $existeConcesionario = mirarDatos($datos);
    $archivo = fopen("../Model/concesionarios.txt", "a");
    if (!$existeConcesionario) {
        echo "<p style='red';>Este concesionario no esta registrado </p>";
    }else{
        
    
    fclose($archivo);
    header("Location: listarCoches.php");
    exit();
    }

    

}

function mirarDatos($datos)
{
    if(!file_exists("../Model/concesionarios.txt")) return false;

    $file = fopen("../Model/concesionarios.txt", "r");

    while (($linea = fgets($file)) !== false) {
        if (trim($linea) === $datos ) {
            fclose($file);
            return true;
        }
    }
    fclose($file);
    return false;
}

require_once '../View/login.php';
?>