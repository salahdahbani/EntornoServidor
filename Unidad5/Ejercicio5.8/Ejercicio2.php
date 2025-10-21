<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Pedido de Comida Rápida</title>
    <style> /* Uso de ia en estilo */
        body { font-family: Arial, sans-serif; max-width: 900px; margin: 20px auto; }
        fieldset { margin-bottom: 16px; padding: 12px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        .controls { display:flex; gap:8px; }
    </style>
</head>
<body>
    <h1>Pedido de Comida Rápida</h1>
    <?php

$menu = [
    'Pizza' => ['jamon', 'atun', 'bacon', 'pepperoni'],
    'Hamburguesa' => ['lechuga', 'tomate', 'queso'],
    'Perrito' => ['lechuga', 'cebolla', 'patata']
];

function obtener_pedido_desde_request() {
    if (isset($_REQUEST['order']) && $_REQUEST['order'] !== '') {
        $un = @unserialize($_REQUEST['order']);
        if ($un !== false || $_REQUEST['order'] === serialize(false)) {
            return $un;
        }
    }
    return [];
}

$pedido = obtener_pedido_desde_request();

if (isset($_REQUEST['add_pizza'])) {
    $variante = isset($_REQUEST['pizza_variante']) ? $_REQUEST['pizza_variante'] : 'sin especificar';
    $ingredientes = isset($_REQUEST['pizza_extra']) ? (array)$_REQUEST['pizza_extra'] : [];
    $item = ['tipo' => 'Pizza', 'variante' => $variante, 'ingredientes' => $ingredientes];
    $pedido[] = $item;
}

if (isset($_REQUEST['add_hamburguesa'])) {
    $ingredientes = isset($_REQUEST['hamburguesa_ingred']) ? (array)$_REQUEST['hamburguesa_ingred'] : [];
    $item = ['tipo' => 'Hamburguesa', 'variante' => 'estandar', 'ingredientes' => $ingredientes];
    $pedido[] = $item;
}

if (isset($_REQUEST['add_perrito'])) {
    $ingredientes = isset($_REQUEST['perrito_ingred']) ? (array)$_REQUEST['perrito_ingred'] : [];
    $item = ['tipo' => 'Perrito Caliente', 'variante' => 'estandar', 'ingredientes' => $ingredientes];
    $pedido[] = $item;
}

if (isset($_REQUEST['clear_order'])) {
    $pedido = [];
}

$finalizado = isset($_REQUEST['finalizar_pedido']);
$pedido_serializado = serialize($pedido);
?>

    <form method="post">
        <fieldset>
            <legend>Pizza</legend>
            <label>Variante:
                <select name="pizza_variante">
                    <?php foreach ($menu['Pizza'] as $v): ?>
                        <option value="<?php echo $v; ?>"><?php echo ucfirst($v); ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
            <div>
                <p>Extras:</p>
                <label><input type="checkbox" name="pizza_extra[]" value="extra_queso"> Extra queso</label>
                <label><input type="checkbox" name="pizza_extra[]" value="aceitunas"> Aceitunas</label>
                <label><input type="checkbox" name="pizza_extra[]" value="champiñones"> Champiñones</label>
            </div>
            <input type="hidden" name="order" value="<?php echo $pedido_serializado; ?>">
            <div class="controls">
                <button type="submit" name="add_pizza">Añadir Pizza</button>
            </div>
        </fieldset>
    </form>

    <form method="post">
        <fieldset>
            <legend>Hamburguesa</legend>
            <p>Ingredientes:</p>
            <?php foreach ($menu['Hamburguesa'] as $ing): ?>
                <label><input type="checkbox" name="hamburguesa_ingred[]" value="<?php echo $ing; ?>"> <?php echo ucfirst($ing); ?></label>
            <?php endforeach; ?>
            <input type="hidden" name="order" value="<?php echo $pedido_serializado; ?>">
            <div class="controls">
                <button type="submit" name="add_hamburguesa">Añadir Hamburguesa</button>
            </div>
        </fieldset>
    </form>

    <form method="post">
        <fieldset>
            <legend>Perrito Caliente</legend>
            <p>Ingredientes:</p>
            <?php foreach ($menu['Perrito'] as $ing): ?>
                <label><input type="checkbox" name="perrito_ingred[]" value="<?php echo $ing; ?>"> <?php echo ucfirst($ing); ?></label>
            <?php endforeach; ?>
            <input type="hidden" name="order" value="<?php echo $pedido_serializado; ?>">
            <div class="controls">
                <button type="submit" name="add_perrito">Añadir Perrito</button>
            </div>
        </fieldset>
    </form>

    <form method="post">
        <input type="hidden" name="order" value="<?php echo $pedido_serializado; ?>">
        <div class="controls">
            <button type="submit" name="finalizar_pedido">Finalizar pedido</button>
            <button type="submit" name="clear_order">Vaciar pedido</button>
        </div>
    </form>

    <hr>

    <?php if ($finalizado): ?>
        <h2>Pedido finalizado</h2>
        <?php if (count($pedido) === 0): ?>
            <p>No hay elementos en el pedido.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tipo</th>
                        <th>Variante</th>
                        <th>Ingredientes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pedido as $i => $item): ?>
                        <tr>
                            <td><?php echo $i + 1; ?></td>
                            <td><?php echo $item['tipo']; ?></td>
                            <td><?php echo $item['variante']; ?></td>
                            <td><?php echo implode(', ', $item['ingredientes']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    <?php else: ?>
        <h2>Pedido en curso</h2>
        <?php if (count($pedido) === 0): ?>
            <p>Aún no has añadido nada al pedido.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tipo</th>
                        <th>Variante</th>
                        <th>Ingredientes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pedido as $i => $item): ?>
                        <tr>
                            <td><?php echo $i + 1; ?></td>
                            <td><?php echo $item['tipo']; ?></td>
                            <td><?php echo $item['variante']; ?></td>
                            <td><?php echo implode(', ', $item['ingredientes']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    <?php endif; ?>

</body>
</html>
