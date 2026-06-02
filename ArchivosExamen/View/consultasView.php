<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consultas de Animales</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; background-color: #f9f9f9; padding: 20px; }
        .search-container { background: white; max-width: 500px; margin: 20px auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; }
        input[type="text"] { width: 65%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; }
        .btn-blue { background-color: #007BFF; color: white; border: none; padding: 8px 15px; cursor: pointer; border-radius: 4px; }
        table { margin: 20px auto; border-collapse: collapse; background-color: #fff; width: 80%; max-width: 600px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background-color: #e6f2ff; }
        .btn-green { display: inline-block; background-color: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; font-weight: bold; margin-top: 15px; border: none; cursor: pointer; }
        .btn-back { display: inline-block; margin-top: 25px; color: #555; text-decoration: none; border: 1px solid #555; padding: 8px 15px; border-radius: 4px; }
    </style>
</head>
<body>

    <h1>Consultas de animales</h1>
    
    <div class="search-container">
        <form action="index.php?action=consultas" method="POST">
            <input type="text" name="busqueda" value="<?= htmlspecialchars($busqueda) ?>" placeholder="Ej: eja, cerdo, ca...">
            <button type="submit" class="btn-blue">Filtrar</button>
        </form>
    </div>

    <?php if (count($animalesFiltrados) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Especie</th>
                    <th>Cantidad</th>
                    <th>Comida Preferida</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($animalesFiltrados as $animal): ?>
                    <tr>
                        <td><?= $animal->getId() ?></td>
                        <td><strong><?= htmlspecialchars($animal->getEspecie()) ?></strong></td>
                        <td><?= $animal->getCantidad() ?></td>
                        <td><?= htmlspecialchars($animal->getComida()) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <form action="index.php?action=generarFichero" method="POST">
            <input type="hidden" name="busqueda" value="<?= htmlspecialchars($busqueda) ?>">
            <button type="submit" class="btn-green">Generar Fichero</button>
        </form>

    <?php else: ?>
        <p style="color: #f44336; margin-top: 20px;">No se encontraron especies que coincidan con la consulta.</p>
    <?php endif; ?>

    <br>
    <a href="index.php?action=listar" class="btn-back">Volver al menú principal</a>

</body>
</html>