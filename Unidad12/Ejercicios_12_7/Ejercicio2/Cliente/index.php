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
	<h1>Consulta de la API barajas</h1>
	<div class="contenedor">

			<form action="peticion.php" method="post">
				<h2>Introduce número</h2>
				Número <input type="number" name="numero" required>
				<input type="submit" name="filtraCartas" value="Filtrar">
			</form><hr>
			<hr>
	</div>
	</body>
</html>