<?php
$archivo = "usuarios.txt" ;
if(session_status() == PHP_SESSION_NONE) session_start();
//Inicializamos la sesion
if(!isset($_SESSION['user'])){
    $_SESSION['user']=[]; 
}

if (isset($_POST['entrar'])) {
if(isset($_SESSION['user'])){
    $user = $_POST['user'];
    $_SESSION['user'] = [
        'user'=> $user,
    ];
    header("location: principal.php");
    exit;
} 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="post" >
    <label>Introduce tu usuario:</label>
    <input type="text" name="user">
    <br>
    <input type="hidden" value="<?php  echo $_SESSION['user']['user']?>">
    <input type="submit" value="Entrar" name="entrar">
    <br><br>
</form>   
</body>
</html>