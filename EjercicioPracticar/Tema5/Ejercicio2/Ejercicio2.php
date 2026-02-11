<?php
$menu = [
    "Pizza" => ["jamon", "atun", "bacon", "pepperoni"] ,
    "Hamburguesa" => ["lechuga","tomate", "queso"] ,
    "Perrito" => ["lechuga", "cebolla", "patata"]
];

$pedido = [];
if (isset($_POST['pedido_hidden'])) {
    $pedido = unserialize(base64_decode($_POST['pedido_hidden']));
}

if (isset($_POST['añadirPizza'])){
    $ingredientes = isset($_POST['ingredientesPizza']) ? $_POST['ingredientesPizza'] : [];
    $item = ["tipo" => "Pizza", "ingredientes" => $ingredientes];
    $pedido[] = $item;
}

if (isset($_POST['añadirHamb'])){
    $ingredientes = isset($_POST['ingredientesHamburguesa']) ? $_POST['ingredientesHamburguesa'] : [];
    $item = ["tipo" => "Hamburguesa", "ingredientes" => $ingredientes];
    $pedido[] = $item;
}

if (isset($_POST['añadirPerrito'])){
    $ingredientes = isset($_POST['ingredientesPerrito']) ? $_POST['ingredientesPerrito'] : [];
    $item = ["tipo" => "Perrito", "ingredientes" => $ingredientes];
    $pedido[] = $item;
}

if(isset($_POST['clear_order'])){
    $pedido = [];
}
if(isset($_POST['eliminar'])){
    $index = $_POST['posicion'];
    unset($pedido[$index]);
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
    <form method="post">
                <input type="hidden" name="pedido_hidden" value="<?php echo base64_encode(serialize($pedido)); ?>">

        <label>Pizza</label>
        <br>
         <?php
         foreach($menu["Pizza"] as $ing){
            ?>
            <label><?php echo $ing ?></label>
            <input type="checkbox" name="ingredientesPizza[]" value="<?php echo $ing ?>">
            <?php
         }
            ?>
            <br>
            <input type="submit" name="añadirPizza" value="Añadir al carrito">
            <br><br><br>
             <label>Hamburguesa</label>
        <br>
         <?php
         foreach($menu["Hamburguesa"] as $ing){
            ?>
            <label><?php echo $ing ?></label>
            <input type="checkbox" name="ingredientesHamburguesa[]" value="<?php echo $ing ?>">
            <?php
         }
            ?>
            <br>
            <input type="submit" name="añadirHamb" value="Añadir al carrito">
            <br><br><br>
             <label>Perrito Caliente</label>
        <br>
         <?php
         foreach($menu["Perrito"] as $ing){
            ?>
            <label><?php echo $ing ?></label>
            <input type="checkbox" name="ingredientesPerrito[]" value="<?php echo $ing ?>">
            <?php
         }
            ?>
            <br>
            <input type="submit" name="añadirPerrito" value="Añadir al carrito">
            <br><br><br>
            </form>
            <form method="post" action="finalizacion.php">
                <input type="hidden" name="pedido_hidden" value="<?php echo base64_encode(serialize($pedido)); ?>">
            <input type="submit" name="finalizar" value="finalizar">
            <button type="submit" name="clear_order">Vaciar pedido</button>
    </form>
    
    <?php
    if(isset($_POST['finalizar'])){
        if(count($pedido)> 0){
             echo "<table border=1>
        <tr>
        <th> Número </th>
        <th> Pedido </th>
        <th> Ingredientes </th>
        </tr>";
        $numero = 1;
         foreach ($pedido as $i => $item){ ?>
        <tr>
        <td><?php echo $numero ?> </td>
        <td> <?php echo $item["tipo"] ?> </td>
        <td><?php echo  implode(', ', $item['ingredientes'])?> </td>
        
        </tr>
        <?php
        $numero++;
        }
        echo "</table>";
           
        }else{
        echo "<h1>No hay elementos escogidos </h1>";
    }
}else{
    echo "Pedido en proceso";
    echo "<table border=1>
        <tr>
        <th> Número </th>
        <th> Pedido </th>
        <th> Ingredientes </th>
        </tr>";
        $numero = 1;
         foreach ($pedido as $i => $item){ ?>
        <tr>
        <td><?php echo $numero ?> </td>
        <td> <?php echo $item["tipo"] ?> </td>
        <td><?php echo  implode(', ', $item['ingredientes'])?> </td>
        <form method="post">
            <input type="hidden" name="pedido_hidden" value="<?php echo base64_encode(serialize($pedido)); ?>">
            <input type="hidden" name="posicion" value="<?php echo $i; ?>">
            <td><input type="submit" value="eliminar" name="eliminar"></td>
        </form>
        </tr>
        <?php
        $numero++;
        }
        echo "</table>";
    }

    ?>
    
</body>
</html>
