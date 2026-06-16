<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Rent a Car</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; background-color: #f9f9f9; padding: 20px; }
        .info-header { font-size: 1.2rem; font-weight: bold; margin-bottom: 5px; color: #333; }
        
        /* Estilo para la barra de última acción realizada */
        .log-accion { 
            display: inline-block;
            background-color: #fff9db; 
            color: #856404; 
            border: 1px solid #ffeeba; 
            padding: 8px 20px; 
            border-radius: 4px; 
            font-size: 1rem; 
            font-weight: 500;
            margin-bottom: 25px; 
        }
        
        table { margin: 0 auto; border-collapse: collapse; background-color: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        th, td { border: 1px solid #ccc; padding: 10px 15px; text-align: center; vertical-align: middle; }
        th { background-color: #e6f2ff; text-transform: uppercase; font-size: 0.85rem; }
        .input-sumar { width: 55px; padding: 5px; text-align: center; border: 1px solid #ccc; border-radius: 4px; margin-right: 5px; }
        .btn-add { background-color: #007BFF; color: white; border: none; padding: 6px 12px; cursor: pointer; border-radius: 4px; font-weight: bold; }
        .btn-add:hover { background-color: #0056b3; }
        .btn-delete { background-color: #f44336; color: white; border: none; padding: 6px 12px; cursor: pointer; border-radius: 4px; text-decoration: none; font-size: 0.85rem; margin-left: 10px; display: inline-block; }
        .btn-main { display: inline-block; margin: 15px 5px; padding: 10px 20px; background-color: #fff; border: 1px solid #000; border-radius: 5px; font-weight: bold; text-decoration: none; color: #000; }
        .acciones-container { display: flex; align-items: center; justify-content: center; }
    </style>
</head>
<body>

    <h1>Rent a Car</h1>
    
    <div class="info-header">
        Categoria más numerosa: <?= $categoriaMasNumerosa ?> (<?= $maxCantidad ?> uds)
    </div>

    <div class="log-accion">
        <strong>Última acción:</strong> <?= htmlspecialchars($ultimaAccion) ?>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Modelo</th>
                <th>categoria</th>
                <th>disponible</th>
                <th>Unidades</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaVehiculos as $vehiculo): ?>
                <tr>
                    <td><?= $vehiculo->getId() ?></td>
                    <td><strong><?= htmlspecialchars($vehiculo->getModelo()) ?></strong></td>
                    <td><?= $vehiculo->getCategoria() ?></td>
                    <td>
                    <form action="actualizarVehiculo.php" method="POST" style="margin: 0;">
                            <input type="hidden" name="id" value="<?= $vehiculo->getId() ?>">
                            <input type="hidden" name="modelo" value="<?= htmlspecialchars($vehiculo->getModelo()) ?>">
                            <input type="hidden" name="categoria" value="<?= htmlspecialchars($vehiculo->getCategoria()) ?>">
                            
                            <?php if($vehiculo->getDisponible() == 1): ?>
                                <input type="hidden" name="nuevo_estado" value="0">
                                <button type="submit" class="btn-status btn-disponible">Disponible</button>
                            <?php else: ?>
                                <input type="hidden" name="nuevo_estado" value="1">
                                <button type="submit" class="btn-status btn-alquilado">Alquilado</button>
                            <?php endif; ?>
                        </form>
                    </td>
                    <?php 
        // Forzamos a entero para asegurarnos de que coincida con el tipo de datos de la sesión
        $idVehiculo = $vehiculo->getId(); 
    ?>
        <td>
            <?php 
                echo isset($_SESSION['cantidad'][$idVehiculo]) 
                    ? $_SESSION['cantidad'][$idVehiculo] 
                    : 0; 
            ?> uds
        </td>
                    <td>
                        
                        <div class="acciones-container">
                            <form action="index.php?action=añadir" method="POST" style="display: inline-flex; margin: 0;">
                                <input type="hidden" name="id" value="<?= $vehiculo->getId() ?>">
                                <input type="number" name="cantidad_sumar" class="input-sumar" value="1" min="1">
                                <button type="submit" class="btn-add">Añadir</button>
                            </form>
                            <a href="index.php?action=eliminar&id=<?= $vehiculo->getId() ?>" class="btn-delete" onclick="return confirm('¿Eliminar registro?')">Eliminar</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        <a href="index.php?action=formularioAgregar" class="btn-main">Nuevo Vehiculo en el Garaje</a>
        <a href="index.php?action=consultas" class="btn-main">Realizar Consulta</a>
    </div>

</body>
</html>