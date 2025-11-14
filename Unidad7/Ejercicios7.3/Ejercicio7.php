<?php
if(!isset($_COOKIE['color'])){
    setcookie("color", "white" , time() + 3*24*3600);
    $color = "white";
}else {
 $color = $_POST['color'];
}

if (isset($_POST["color"])) {
    $color = $_POST["color"];
    setcookie("color", $color , time() + 3*24*3600);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="background-color: <?=$color?>;">
    <form method="post">
        <label>Introduce el color:</label>
        <br>
        <input type="color" name="color" value="<?=$color?>">
        <br>
        <br>
        <button type="submit" name="aplicar">Aplicar</button>
    </form>
    
    
</body>
</html>