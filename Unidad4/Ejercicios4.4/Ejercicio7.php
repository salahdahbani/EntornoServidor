<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    
    if (!isset($_REQUEST['claveintroducida'])) {
         $oportunidades=4;
        $clave=3567;
        $claveintroducida=0;
       
    }else{
        $clave= $_POST['clave'];
        $claveintroducida = $_POST['claveintroducida'];
        $oportunidades = $_POST['oportunidades'];
       
    }
    if($claveintroducida == $clave){
               echo "La caja fuerte se ha abierto satisfactoriamente";

    }else{
        if($oportunidades == 0){
            echo "Lo siento, has agotado todas tus oportunidades.";
        }else{
           
        
    
    ?>
    Te quedan <?= $oportunidades-- ?> oportunidades.<br>
Introduce la clave correcta
    <form action="" method="post">
<input type="password" name="claveintroducida">
<input type="hidden" name="oportunidades" value="<?= $oportunidades ?>">
<input type="hidden" name="clave" value= "<?= $clave ?>">
<input type="submit" value="Continuar">
</form>
</body>
</html>
<?php
        }
    }
    ?>