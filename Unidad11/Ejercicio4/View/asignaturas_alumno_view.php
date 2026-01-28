<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Listado de alumnos</title>
</head>
<body>
<h1>Blog de asignaturas por alumno</h1>
<hr>

<h3>Alumno: <?= isset($data['unAlumno']) ? $data['unAlumno']->getNombre() . " " . $data['unAlumno']->getApellido() : "Alumno no encontrado" ?></h3>
<table border="1" color="black">
    <tr>
        <td>Asignaturas</td>
        
    </tr>
<?php
foreach($data['susAsignaturas'] as $asignatura) {
?>
    <tr>
        <td><?= $asignatura->getNombre() ?></td>
        
        <td>
            <a href="../Controller/desmatricularAlumno.php?codigo=<?= $asignatura->getCodigo() ?>&matricula=<?= $data['unAlumno']->getMatricula() ?>">
                Desatricular
            </a>
        </td>
    </tr>
<?php
}
?>
</table>
<br>
<hr>
<hr>
<?php if ($data['unAlumno']){ ?>
    <a href="../Controller/nuevaMatricula.php?matricula=<?= $data['unAlumno']->getMatricula() ?>">Matricular</a>
<?php }?>
<br>
<a href="../Controller/index.php">Volver</a>
<br>
</body>
</html>