<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Listado de alumnos</title>
</head>
<body>
<h1>Blog de alumnos por matricula</h1>
<hr>

<h3>Asignatura: <?=$data['asignatura']->getNombre()?></h3>
<table border="1" color="black">
    <tr>
        <td>Alumnos</td>
        
    </tr>
<?php
foreach($data['alumno'] as $alumno) {
?>
    <tr>
        <td><?=$alumno->getNombre()?> <?=$alumno->getApellido()?></td>
        <td>
            <a href="../Controller/desmatricularAlumno.php?matricula=<?=$alumno->getMatricula()?>&codigo=<?=$data['asignatura']->getCodigo()?>">
                Desmatricular
            </a>
        </td>
    </tr>
<?php
}
?>
</table>
<br>
<hr>
<a href="../Controller/index_asignatura.php">Volver</a>
<br>
</body>
</html>