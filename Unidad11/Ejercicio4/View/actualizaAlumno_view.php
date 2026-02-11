<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title></title>
</head>
<body>
<form action="../Controller/updateAlumno.php"  method="POST">
<input type="hidden" name="matricula" value="<?= $data['alumno']->getMatricula() ?>">
<h3>Nombre</h3>
<input type="text" size="40" name="nombre" value="<?= $data['alumno']->getNombre() ?>">
<h3>Apellido</h3>
<input type="text" size="40" name="apellido" value="<?= $data['alumno']->getApellido() ?>">
<h3>Curso</h3>
<input type="text" size="40" name="curso" value="<?= $data['alumno']->getCurso() ?>">
<hr>
<input type="submit" value="Aceptar">
</form>
</body>
</html>