<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Añadir Animal</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; background-color: #f9f9f9; padding: 4px; }
        .form-container { width: 300px; margin: 50px auto; padding: 20px; background: white; border: 1px solid #ccc; box-shadow: 0 2px 4px rgba(0,0,0,0.1); border-radius: 5px; text-align: left; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-group select, .form-group input { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        .btn-submit { background-color: #0056b3; color: white; border: none; padding: 10px; width: 100%; cursor: pointer; border-radius: 4px; font-size: 1rem; }
        .btn-back { display: block; text-align: center; margin-top: 15px; color: #555; text-decoration: none; }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Nuevo Habitacion</h2>
        <form action="index.php?action=guardarNuevo" method="POST">

        <div class="form-group">
                <label for="numero">Numero :</label>
                <input type="text" name="numero" id="numero" required>
            </div>
            
            <div class="form-group">
                <label for="tipo">Tipo:</label>
                <select name="tipo" id="tipo" required>
                    <option value="">-- Selecciona un tipo --</option>
                    <?php foreach ($listaTipos as $tip): ?>
                        <option value="<?= htmlspecialchars($tip->getId()) ?>">
                            <?= htmlspecialchars($tip->getNombre()) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="precio">Precio Inicial:</label>
                <input type="number" name="precio" id="precio" min="1" value="1" required>
            </div>

            <div class="form-group">
                <label for="capacidad">Capacidad Inicial:</label>
                <input type="number" name="capacidad" id="capacidad" required>
            </div>

            <button type="submit" class="btn-submit">Dar de Alta en el Hotel</button>
            <a href="index.php" class="btn-back">Volver al listado</a>
        </form>
    </div>

</body>
</html>