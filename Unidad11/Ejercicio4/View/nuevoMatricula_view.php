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
<table border="1" color="black">
    <tr>
        <td>Asignaturas</td>
        
    </tr>
<?php foreach($data['asignatura_libres'] as $asig) { ?>
    <tr>
        <td><?= $asig->getCodigoAsignatura() ?></td>
        <td>
            <a href="../Controller/grabaMatricula.php?codigo=<?= $asig->getCodigoAsignatura() ?>&matricula=<?= $data['unAlumno']->getMatricula() ?>">
                Matricular
            </a>
        </td>
    </tr>
<?php } ?>
</table>
<br>
<hr>
<a href="../Controller/index.php">Volver</a>
<br>
</body>
</html>