<?php
if (session_status() == PHP_SESSION_NONE) session_start();
    session_destroy();
    setcookie("carro", "", -1);
    header("Location: index.php");
    exit();
//Se cierra la sesion y cookie
?>
