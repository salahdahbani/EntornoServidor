<?php
if (session_status() == PHP_SESSION_NONE) session_start();

if (isset($_GET['producto'])) {
    $_SESSION['producto'] = $_GET['producto'];
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle</title>
    <style>
        * {
            font-family: sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            margin-bottom: 40px;
        }

        a {
            padding: 10px;
            text-decoration: none;
            color: black;
            border: 1px solid;

        }
        h1{
            text-align: center;
            font-size: 3em;
            margin: 0;
        }

        .botonCompra{
            padding: 10px;
        }
    </style>
</head>

<body>
    <?php
    foreach ($_SESSION['productos'] as $productos => $datos) {
        if ($datos['nombre'] == $_SESSION['producto']) {
    ?>
            
            <div class="container">
                <h1>Detalle</h1>
                <img src="<?= $datos['img'] ?>" alt="">
                <h2>Producto: <?= $datos['nombre'] ?></h2>
                <p><strong>Precio:</strong> <?= $datos['precio'] ?></p>
                <p><strong>Descripción:</strong><?= $datos['descripcion'] ?></p>
                <form action="meteCarro.php" method="post">
                    <input type="hidden" name="seleccionado1" value="<?= $datos["nombre"] ?>">
                    <input type="submit" class="botonCompra" value="Comprar" >
                </form>
                <a href="index.php">Volver a la tienda</a>
            </div>
    <?php
        }
    }
    ?>
</body>

</html>