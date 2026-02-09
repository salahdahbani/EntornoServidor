<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="estilos.css" type="text/css"> 
	<title>Document</title>
</head>
<body>
	<h1>Consulta de la API alumnos</h1>
	<div class="contenedor">

			<form action="peticion.php" method="post">
				<h2>Filtro por grupo:</h2>
				Grupo <input type="text" name="grupo">
				<input type="submit" name="filtraGrupo" value="Filtrar">
			</form><hr>
			<form action="peticion.php" method="post">
				<h2>Filtro por cadena:</h2> 
				Cadena <input type="text" name="cadena">
				<input type="submit" name="filtraCadena" value="Filtrar">
			</form><hr>
			<form action="peticion.php" method="post">
				<h2>Inserta el alumno:</h2> 
				Nombre <input type="text" name="nombre" >
				<input type="submit" name="filtrarAsignaturas" value="FiltrarAsignaturas">
			</form><hr>
			<form action="peticion.php" method="post">
				<h2>Matricular alumno:</h2> 
				Nombre <input type="text" name="nombre" >
				Asignatura <input type="text" name="codigo_asig" >
				<input type="submit" name="matricular" value="Matricular">
			</form><hr>
			<form action="peticion.php" method="post">
				<h2>Cambiar de grupo:</h2> 
				Nombre <input type="text" name="nombre" >
				Grupo <input type="text" name="grupo" >
				<input type="submit" name="cambiarGrupo" value="Cambiar Grupo">
			</form><hr>
			<form action="peticion.php" method="POST">
				<h2>Borrar alumno:</h2> 
				Nombre <input type="text" name="nombre" >
				<input type="submit" name="borrar" value="Borrar">
			</form><hr>
	</div>
	</body>
</html>