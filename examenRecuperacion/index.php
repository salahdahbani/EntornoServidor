<?php
session_start();
require_once("Libro.php");

// LOGIN SIMPLE
if (isset($_POST['usuario'])) {
    $_SESSION['usuario'] = $_POST['usuario'];
}

// SI NO HAY USUARIO → FORMULARIO
if (!isset($_SESSION['usuario'])) {
?>
    <form method="POST">
        Usuario: <input type="text" name="usuario" required>
        <button type="submit">Entrar</button>
    </form>
<?php
    exit;
}

if(isset($_GET['logout'])) {
    session_destroy();
    header("location: index.php");
    exit;
}

echo "<h2>USUARIO: " . $_SESSION['usuario'] . "</h2>";
echo "<a href='?logout'>Cerrar sesión</a><br><br>";

// LEER FICHERO
$libros = [];
$lineas = file("libros.txt");

foreach ($lineas as $linea) {
    $partes = explode(",", trim($linea));
    $libros[] = new Libro($partes[0], $partes[1], $partes[2], $partes[3]);
}

// ACCIONES
if (isset($_GET['prestar'])) {
    $i = $_GET['prestar'];
    $libros[$i]->prestar($_SESSION['usuario']);
}

if (isset($_GET['devolver'])) {
    $i = $_GET['devolver'];
    $libros[$i]->devolver();
}

// GUARDAR CAMBIOS
$contenido = "";
foreach ($libros as $libro) {
    $contenido .= "{$libro->titulo},{$libro->estado},{$libro->nombre},{$libro->fecha}\n";
}
file_put_contents("libros.txt", $contenido);

// MOSTRAR TABLA
echo "<table border='1'>";
echo "<tr><th>Título</th><th>Estado</th><th>Nombre</th><th>Fecha</th><th>Acción</th></tr>";

foreach ($libros as $i => $libro) {

    // CONTROL DE 5 DÍAS
    $style = "";
    if ($libro->estado == "prestado" && $libro->fecha != "") {
        $fechaPrestamo = new DateTime($libro->fecha);
        $hoy = new DateTime();
        $dias = $hoy->diff($fechaPrestamo)->days;

        if ($dias > 5) {
            $style = "style='color:red'";
        }
    }

    echo "<tr $style>";
    echo "<td>{$libro->titulo}</td>";
    echo "<td>{$libro->estado}</td>";
    echo "<td>{$libro->nombre}</td>";
    echo "<td>{$libro->fecha}</td>";

    if ($libro->estado == "libre") {
        echo "<td><button onclick='location.href=\"?prestar=$i\"'>Prestar</button></td>";
    } else {
        echo "<td><button onclick='location.href=\"?devolver=$i\"'>Devolver</button></td>";
    }

    echo "</tr>";
}

echo "</table>";
?>