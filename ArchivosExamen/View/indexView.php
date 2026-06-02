<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Granja El Arca de Noé</title>
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

    <h1>Granja El Arca de Noé</h1>
    
    <div class="info-header">
        Especie más numerosa: <?= htmlspecialchars($especieMasNumerosa) ?> (<?= $maxCantidad ?> uds)
    </div>

    <div class="log-accion">
        <strong>Última acción:</strong> <?= htmlspecialchars($ultimaAccion) ?>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Especie</th>
                <th>Cantidad Actual</th>
                <th>Comida</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaAnimales as $animal): ?>
                <tr>
                    <td><?= $animal->getId() ?></td>
                    <td><strong><?= htmlspecialchars($animal->getEspecie()) ?></strong></td>
                    <td><?= $animal->getCantidad() ?> uds</td>
                    <td><?= htmlspecialchars($animal->getComida()) ?></td>
                    
                    <td>
                        <div class="acciones-container">
                            <form action="index.php?action=añadir" method="POST" style="display: inline-flex; margin: 0;">
                                <input type="hidden" name="id" value="<?= $animal->getId() ?>">
                                <input type="number" name="cantidad_sumar" class="input-sumar" value="1" min="1">
                                <button type="submit" class="btn-add">Añadir</button>
                            </form>
                            <a href="index.php?action=eliminar&id=<?= $animal->getId() ?>" class="btn-delete" onclick="return confirm('¿Eliminar registro?')">Eliminar</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        <a href="index.php?action=formularioAgregar" class="btn-main">Nuevo Animal en la Granja</a>
        <a href="index.php?action=consultas" class="btn-main">Realizar Consulta</a>
    </div>

</body>
</html>