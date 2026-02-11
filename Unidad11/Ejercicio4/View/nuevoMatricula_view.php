<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Listado de matriculas</title>
</head>
<body>
<h1>Blog de matriculas</h1>
<hr>


<h3>Alumno: <?= isset($data['unAlumno']) ? $data['unAlumno']->getNombre() . " " . $data['unAlumno']->getApellido() : "Alumno no encontrado" ?></h3>
<?php if (isset($data['asignatura_libres']) && count($data['asignatura_libres']) > 0) {?>
<table border="1">
    <tr>
        <th>Asignaturas</th>
        <th>Acción</th>
    </tr>

    <?php foreach ($data['asignatura_libres'] as $asigAlumno) { ?>
        <?php
        // Buscar el objeto Asignatura que coincide con el código
        $asignaturaObj = null;
        foreach ($data['asignaturas'] as $asig) {
            if ($asig->getCodigo() == $asigAlumno->getCodigoAsignatura()) {
                $asignaturaObj = $asig;
            }
        }
        ?>
        <?php if ($asignaturaObj)  { ?>
        <tr>
            <td><?= $asignaturaObj->getNombre() ?></td>
            <td>
                <a href="../Controller/grabaMatricula.php?codigo=<?= $asigAlumno->getCodigoAsignatura() ?>&matricula=<?= $asigAlumno->getMatricula() ?>">
                    Matricular
                </a>
            </td>
        </tr>
        <?php } ?>
    <?php } ?>
</table>
<?php }else { ?>
<p>No hay asignaturas libres para matricular.</p>
<?php } ?>

<br>
<hr>
<a href="../Controller/index.php">Volver</a>
<br>
</body>
</html>