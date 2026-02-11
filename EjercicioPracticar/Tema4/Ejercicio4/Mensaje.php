<?php
 if(isset($_POST['Llamar'])) {
        $i=$_POST['i'];
        $j=$_POST['j'];
        echo "<h3>Usted ha llamado al piso $j del bloque $i</h3>";
     }
?>