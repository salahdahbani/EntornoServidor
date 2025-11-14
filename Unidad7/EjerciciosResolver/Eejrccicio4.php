<!--Ejercicio 4
Vamos a realizar una web para control de préstamos de libros de una biblioteca, para ello se almacenarán los
datos de los libros prestados en las cookies del propio usuario (aunque no es lo ideal, nos vale para practicar el
uso de sesiones y cookies). Cada vez que el usuario realice un préstamo se almacenará el título del libro y la
fecha de préstamo que, aunque debería ser la fecha actual, vamos a seleccionarla de un input tipo fecha para
poder hacer pruebas.
Por tanto, al entrar en la aplicación se mostrará un listado de los libros pendientes de entrega, con los campos
fecha de préstamo, fecha de devolución (7 días después) y días restantes de préstamo, pero para aquellos que
haya pasado el plazo de devolución, el texto será de color rojo con el mensaje ¡RETRASADO! y el importe
acumulado por retraso (2 euros por día de retraso).
Si al devolver un libro estamos en plazo, el registro de ese libro será eliminado sin más, pero si se trata de un
libro retrasado, se sumará el importe por retraso al importe total acumulado de todas las entregas retrasadas,
que será almacenado también en una cookie, de manera que en la página principal se mostrará junto al listado 
-->
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['libros']) && !empty($_SESSION['libros'])) {
    $_COOKIE['total_retraso'] = 0;
    echo "<h2>Libros prestados:</h2>";
    echo "<table border='1'>
            <tr>
                <th>Título</th>
                <th>Fecha de Préstamo</th>
                <th>Fecha de Devolución</th>
                <th>Días Restantes</th>
                <th>Estado</th>
            </tr>";
    $total_retraso = 0;
    foreach($_SESSION['libros'] as $i => $libro) {
        $fecha_prestamo = strtotime($libro['fecha_prestamo']);
        $fecha_devolucion =strtotime("libro['fecha_prestamo'] +7 days");
        $fecha_devolucion = strtotime('+7 days', $fecha_prestamo);
        $hoy = time("m/d/Y");
        $dias_restantes = ($fecha_devolucion - $hoy) / (60 * 60 * 24);
        $retrasado = $hoy > $fecha_devolucion;
        $estilo = "";
        if($retrasado){
            $estilo = "style='color:red;'";
            $dias = ($hoy - $fecha_devolucion) / (60 * 60 * 24);
            $sancion = 2 * $dias;
            $plazo = "¡RETRASADO! $dias días: Sanción de $sancion €";
        }else {
            $dias = ($fecha_devolucion - $hoy) / (60 * 60 * 24);
            $plazo = "$dias días restantes";
            $sancion = 0;
        }

        echo "<tr>";
        echo "<td>{$libro['titulo']}</td>";
        echo "<td>{$libro['fecha_prestamo']}</td>";
        echo "<td>" . date('Y-m-d', $fecha_devolucion) . "</td>";
        if ($retrasado) {
            echo "<td style='$estilo'>$plazo</td>";
        } else {
            echo "<td>$plazo</td>";
            echo "<td>En plazo</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
    if ($total_retraso > 0) {
        echo "<h3>Total acumulado por retrasos: $total_retraso €</h3>";
    }
} else {
    echo "<h2>No hay libros prestados.</h2>";
}
if (isset($_POST['ejercicio']) && $_POST['ejercicio'] == "04_detalle") {
    $titulo = $_POST['titulo'];
    $fecha_prestamo = $_POST['fecha_prestamo'];

    // Añadir el libro prestado a la sesión
    $_SESSION['libros'][] = [
        'titulo' => $titulo,
        'fecha_prestamo' => $fecha_prestamo
    ];
}
if (!isset($_SESSION['libros'])) {
    $_COOKIE['total_retraso'] = 0;
    $_SESSION['libros'] = [];
}   

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form action="pagina.php" method="post">
  <input type="hidden" name="ejercicio" value="04_detalle">
  Título del libro: <input type="text" name="titulo" required>
  Fecha de préstamo: <input type="date" name="fecha_prestamo" required>
  <input type="submit" value="Prestar libro">
</form>
</body>
</html>