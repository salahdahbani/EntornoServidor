<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Listado de alumnos</title>
</head>
<body>
<h1>Blog de alumnos</h1>
<hr>
<table border="1" color="black">
    <tr>
        <td>Matricula</td>
        <td>Nombre</td>
        <td>Apellido</td>
        <td>Curso</td>
        <td><a href="../Controller/grabaAsignatura.php">Asignatura</a></td>
    </tr>
<?php
foreach($data['alumno'] as $alumno) {
?>
    <tr>
        <td><?=$alumno->getMatricula()?></td>
        <td><?=$alumno->getNombre()?></td>
        <td><?=$alumno->getApellido()?></td>
        <td><?=$alumno->getCurso()?></td>
        <td><a href="../Controller/actualizaAlumno.php?matricula=<?=$alumno->getMatricula()?>">Actualizar</a>
        <a href="../Controller/borraAlumno.php?matricula=<?=$alumno->getMatricula()?>">Borrar</a></td>
    </tr>
<?php
}
?>
</table>
<br>
<hr>
<a href="../Controller/nuevoAlumno.php">Nuevo alumno</a>
</body>
</html>