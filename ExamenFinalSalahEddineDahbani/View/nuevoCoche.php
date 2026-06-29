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
        <h2>NUEVO MODELO EN UN CONCESIONARIO</h2>
        <form action="index.php?action=guardarNuevo" method="POST">
            <div class="form-group">
                <label for="modelo">Modelo :</label>
                <input type="text" name="modelo" id="modelo"  required>
            </div>

            <div class="form-group">
                <label for="unidades">Unidades:</label>
                <input type="number" name="unidades" min="1" required>
            </div>

            <div class="form-group">
                <label for="concesionario">Concesionario:</label>
                <select name="concesionario" id="concesionario" required>
                    <?php foreach ($nombreCiudades as $con): ?>
                        <option value="<?= $con ?>">
                            <?= $con ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            

            <button type="submit" class="btn-submit">GRABAR</button>
            <a href="index.php" class="btn-back">VOLVER</a>
        </form>
    </div>

</body>
</html>