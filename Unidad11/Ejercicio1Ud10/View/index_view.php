<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Listado de Clientes</title>
</head>
<body>
    <h1>Gestión de Clientes - Banco</h1>
    <a href="../Controller/nuevoCliente.php">Nuevo cliente</a>
    <hr>
    <table border="1">
        <tr>
            <th>DNI</th>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Acciones</th>
        </tr>
        <?php foreach($data['clientes'] as $cliente): ?>
        <tr>
            <td><?= $cliente->getDNI() ?></td>
            <td><?= $cliente->getNombre() ?></td>
            <td><?= $cliente->getDireccion() ?></td>
            <td><?= $cliente->getTelefono() ?></td>
            <td>
                <a href="../Controller/borraCliente.php?DNI=<?= $cliente->getDNI() ?>">Borrar</a>
                <a href="../Controller/actualizaCliente.php?DNI=<?= $cliente->getDNI() ?>">Editar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>