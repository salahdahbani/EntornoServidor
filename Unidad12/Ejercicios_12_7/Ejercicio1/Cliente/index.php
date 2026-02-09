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
	<h1>Consulta de la API monedas</h1>
	<div class="contenedor">

			<form action="peticion.php" method="post">
				<h2>Introduce cantidad</h2>
				Cantidad <input type="number" name="cantidad" step="0.01">
				<select name="moneda">
					<option value="pesetas">Pesetas</option>
					<option value="EUR">Euro</option>
				<input type="submit" name="filtraPrecio" value="Filtrar">
			</form><hr>
			<hr>
	</div>
	</body>
</html>