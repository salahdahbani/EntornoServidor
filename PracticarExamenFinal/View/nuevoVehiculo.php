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
        <h2>Nuevo Vehiculo</h2>
        <form action="index.php?action=guardarNuevo" method="POST">
            
            <div class="form-group">
                <label for="categoria">Especie:</label>
                <select name="categoria" id="categoria" required>
                    <option value="">-- Selecciona una categoria --</option>
                    <?php foreach ($listaCategorias as $cat): ?>
                        <option value="<?= $cat->getNombre() ?>">
                            <?= $cat->getNombre() ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="modelo">Modelo :</label>
                <input type="text" name="modelo" id="modelo"  required>
            </div>

            <div class="form-group">
                <label for="disponible">Estado:</label>
                <select name="disponible" id="disponible" required>
                    <option value="0">Alquilado</option>
                    <option value="1">Alquilar</option>
                </select>
            </div>

            <button type="submit" class="btn-submit">Dar de Alta en la Granja</button>
            <a href="index.php" class="btn-back">Volver al listado</a>
        </form>
    </div>

</body>
</html>