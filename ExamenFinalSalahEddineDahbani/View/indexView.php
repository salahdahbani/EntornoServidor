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

    <h1>SUMATOR - Listado de coches</h1>
    
    <div class="info-header">       
        Concesionario: <?= $_SESSION['concesionario']['concesionario'] ?> 
    </div>
    <h2><a href="index.php?action=salir" class="btn-salir">Salir</a></h2>

    <form action="index.php?action=consultas" method="POST">
        <input type="radio" name="busqueda" value="">Todos los concesionarios
        <input type="radio" name="busqueda" value="<?= $_SESSION['concesionario']['concesionario'] ?>"><?=  $_SESSION['concesionario']['concesionario'] ?>
            <button type="submit" class="btn-blue">Filtrar</button>
       
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>MODELO</th>
                <th>UNIDADES</th>
                <th>CONCESIONARIO</th>
                <th>BAJA</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaCoches as $coche): ?>
                <tr>
                    <td><?= $coche->getid() ?></td>
                    <td><strong><?= htmlspecialchars($coche->getmodelo()) ?></strong></td>
                    <td><?= $coche->getunidades() ?></td>
                    <td><?= $coche->getconcesionario() ?></td>
                    <td>
                            <a href="index.php?action=eliminar&id=<?= $coche->getid() ?>" class="btn-delete" onclick="return confirm('¿Eliminar registro?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        <a href="index.php?action=formularioAgregar" class="btn-main">Registrar a un nuevo Coche</a>
    </div>

</body>
</html>