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
        <td>Nombre</td>
        <td><a href="../Controller/grabaAlumno.php">Alumnos</a></td>
    </tr>
<?php
foreach($data['asignatura'] as $asignatura) {
?>
    <tr>
        <td><?=$asignatura->getNombre()?></td>
        <td><a href="../Controller/borraAsignatura.php?codigo=<?=$asignatura->getCodigo()?>">Borrar</a></td>
    </tr>
<?php
}
?>
</table>
<br>
<hr>
<a href="../Controller/nuevaAsignatura.php">Nueva asignatura</a>
</body>
</html>