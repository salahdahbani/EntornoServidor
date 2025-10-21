

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Parejas compatibles (simple)</title>
<style>/* Uso de ia en estilo */
 table{border-collapse:collapse;width:100%}
 th,td{border:1px solid #bbb;padding:6px}
 .sel{background:#ffd}
</style>
</head>
<body>
    <?php

// inicializar con datos de prueba si no vienen por formulario
if (!isset($_REQUEST['personas']) || $_REQUEST['personas'] === '') {
    $personas = [
        ['nombre'=>'Anita','sexo'=>'m','orientacion'=>'bis'],
        ['nombre'=>'Lolita','sexo'=>'m','orientacion'=>'bis'],
        ['nombre'=>'Pepito','sexo'=>'h','orientacion'=>'bis'],
        ['nombre'=>'Juanito','sexo'=>'h','orientacion'=>'bis'],
        ['nombre'=>'Roberto','sexo'=>'h','orientacion'=>'het'],
        ['nombre'=>'Antonio','sexo'=>'h','orientacion'=>'het'],
        ['nombre'=>'Manuela','sexo'=>'m','orientacion'=>'het'],
        ['nombre'=>'Isabel','sexo'=>'m','orientacion'=>'het'],
        ['nombre'=>'Jenifer','sexo'=>'m','orientacion'=>'hom'],
        ['nombre'=>'Susan','sexo'=>'m','orientacion'=>'hom'],
        ['nombre'=>'Peter','sexo'=>'h','orientacion'=>'hom'],
        ['nombre'=>'Mike','sexo'=>'h','orientacion'=>'hom']
    ];
} else {
    $personas = @unserialize(base64_decode($_REQUEST['personas']));
    if ($personas === false) $personas = [];
}

$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '1';

// añadir persona desde página 1
if (isset($_REQUEST['add_persona'])) {
    $n = isset($_REQUEST['nombre']) ? $_REQUEST['nombre'] : '';
    $s = isset($_REQUEST['sexo']) ? $_REQUEST['sexo'] : 'h';
    $o = isset($_REQUEST['orientacion']) ? $_REQUEST['orientacion'] : 'het';
    $personas[] = ['nombre'=>$n, 'sexo'=>$s, 'orientacion'=>$o];
}

// ir a pagina 2
if (isset($_REQUEST['to_page2'])) $page = '2';

// en pagina 2, manejar selección y formar pareja
$seleccion = null;
if (isset($_REQUEST['select'])) {
    $seleccion = isset($_REQUEST['idx']) ? $_REQUEST['idx'] : null;
}
if (isset($_REQUEST['formar'])) {
    $page = '3';
    $idx1 = isset($_REQUEST['idx1']) ? $_REQUEST['idx1'] : null;
    $idx2 = isset($_REQUEST['idx2']) ? $_REQUEST['idx2'] : null;
}



?>

<?php if ($page === '1'): ?>
    <h2>Introducir personas</h2>
    <form method="post">
        Nombre: <input name="nombre"> 
        Sexo: <select name="sexo"><option value="h">h</option><option value="m">m</option></select>
        Orient: <select name="orientacion"><option value="het">het</option><option value="hom">hom</option><option value="bis">bis</option></select>
        <input type="hidden" name="personas" value="<?php echo base64_encode(serialize($personas)); ?>">
        <button name="add_persona">Añadir</button>
        <button name="to_page2">Ir a parejas</button>
    </form>

    <h3>Listado</h3>
    <table>
        <tr><th>#</th><th>Nombre</th><th>Sexo</th><th>Orient</th></tr>
        <?php for ($i=0; $i<count($personas); $i++): ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $personas[$i]['nombre']; ?></td>
                <td><?php echo $personas[$i]['sexo']; ?></td>
                <td><?php echo $personas[$i]['orientacion']; ?></td>
            </tr>
        <?php endfor; ?>
    </table>

<?php elseif ($page === '2'): ?>
    <h2>Seleccionar persona</h2>
    <form method="post">
        <input type="hidden" name="personas" value="<?php echo base64_encode(serialize($personas)); ?>">
        <table>
            <tr><th>#</th><th>Nombre</th><th>Sexo</th><th>Orient</th><th>Acción</th></tr>
            <?php for ($i=0; $i<count($personas); $i++): ?>
                <tr <?php if (isset($_REQUEST['idx']) && $_REQUEST['idx']==$i) echo 'class="sel"'; ?>>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $personas[$i]['nombre']; ?></td>
                    <td><?php echo $personas[$i]['sexo']; ?></td>
                    <td><?php echo $personas[$i]['orientacion']; ?></td>
                    <td>
                        <button name="select" type="submit">Seleccionar</button>
                        <input type="hidden" name="idx" value="<?php echo $i; ?>">
                    </td>
                </tr>
            <?php endfor; ?>
        </table>
    </form>

    <?php if (isset($_REQUEST['idx'])): ?>
        <?php $sel = $_REQUEST['idx']; ?>
        <h3>Compatibles con <?php echo $personas[$sel]['nombre']; ?></h3>
        <form method="post">
            <input type="hidden" name="personas" value="<?php echo base64_encode(serialize($personas)); ?>">
            <input type="hidden" name="idx1" value="<?php echo $sel; ?>">
            <table>
                <tr><th>#</th><th>Nombre</th><th>Sexo</th><th>Orient</th><th>Acción</th></tr>
                <?php for ($j=0; $j<count($personas); $j++): ?>
                    <?php if ($j == $sel) continue; ?>
                    <?php
                        $a = $personas[$sel];
                        $b = $personas[$j];
                        $comp = false;
                        if ($a['orientacion'] === 'het') {
                            if ($a['sexo'] !== $b['sexo'] && $b['orientacion'] !== 'hom') $comp = true;
                        } elseif ($a['orientacion'] === 'hom') {
                            if ($a['sexo'] === $b['sexo'] && $b['orientacion'] !== 'het') $comp = true;
                        } elseif ($a['orientacion'] === 'bis') {
                            if (!($b['orientacion']==='het' && $a['sexo']===$b['sexo']) && !($b['orientacion']==='hom' && $a['sexo']!==$b['sexo'])) $comp = true;
                        }
                    ?>
                    <?php if ($comp): ?>
                        <tr>
                            <td><?php echo $j; ?></td>
                            <td><?php echo $b['nombre']; ?></td>
                            <td><?php echo $b['sexo']; ?></td>
                            <td><?php echo $b['orientacion']; ?></td>
                            <td>
                                <button name="formar" type="submit">Formar pareja</button>
                                <input type="hidden" name="idx2" value="<?php echo $j; ?>">
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endfor; ?>
            </table>
        </form>
    <?php endif; ?>

    <p><a href="?page=1&personas=<?php echo base64_encode(serialize($personas)); ?>">Volver a introducir</a></p>

<?php elseif ($page === '3'): ?>
    <h2>Pareja formada</h2>
    <?php
        $idx1 = isset($_REQUEST['idx1']) ? $_REQUEST['idx1'] : null;
        $idx2 = isset($_REQUEST['idx2']) ? $_REQUEST['idx2'] : null;
        if ($idx1!==null && $idx2!==null && isset($personas[$idx1]) && isset($personas[$idx2])):
            $A = $personas[$idx1];
            $B = $personas[$idx2];
    ?>
        <table>
            <tr><th>Persona A</th><th>Persona B</th></tr>
            <tr><td><?php echo $A['nombre'].' ('.$A['sexo'].'/'.$A['orientacion'].')'; ?></td>
                <td><?php echo $B['nombre'].' ('.$B['sexo'].'/'.$B['orientacion'].')'; ?></td></tr>
        </table>
    <?php else: ?>
        <p>Índices inválidos.</p>
    <?php endif; ?>

    <p><a href="?page=2&personas=<?php echo base64_encode(serialize($personas)); ?>">Volver a parejas</a></p>

<?php endif; ?>

</body>
</html>