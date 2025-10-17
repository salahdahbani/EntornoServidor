<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if(!isset($_REQUEST['intentos'])){
        $intentos=10;
    } else {
        $intentos=$_REQUEST['intentos'];
        if ($_REQUEST['oculto'] == $_REQUEST['numero']) {
     
            $intentos--;
    }
    
</body>
</html>