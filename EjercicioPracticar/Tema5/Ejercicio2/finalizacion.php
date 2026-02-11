<?php
$pedido = [];
if (isset($_POST['pedido_hidden'])) {
    $pedido = unserialize(base64_decode($_POST['pedido_hidden']));
}

if(isset($_POST['finalizar'])){
    if(count($pedido)> 0){
        echo "<h1>Pedido finalizado</h1>";
echo "<table border=1>
        <tr>
        <th> Número </th>
        <th> Pedido </th>
        <th> Ingredientes </th>
        </tr>";
         foreach ($pedido as $i => $item){ ?>
        <tr>
        <td><?php echo $i + 1 ?> </td>
        <td> <?php echo $item["tipo"] ?> </td>
        <td><?php echo  implode(', ', $item['ingredientes'])?> </td>
        </tr>
        <?php
        }
        echo "</table>";
    }else {
        echo "<h1>No hay pedidos realizados</h1>";
    }
    }

    echo "<a href='Ejercicio2.php'>Volver al formulario</a>";
        ?>