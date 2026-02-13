<?php
$token = "abc12345";
$url = "http://localhost/EntornoServidor/Unidad12/Ejercicios12.7/Ejercicio3/consultaProductos.php";
$rutaImg = "http://localhost/EntornoServidor/Unidad12/Ejercicios12.7/Ejercicio3/";
if (isset($_REQUEST['filtraPrecio'])) {
    $parametros = '?min=' . $_REQUEST['min'] . '&max=' . $_REQUEST['max'] . "&token=" . $token;
    mostrarDatos($url, $parametros, $rutaImg);
} else if (isset($_REQUEST['filtraNombre'])) {
    $parametros = "?nombre=" . $_REQUEST['nombre'] . "&token=" . $token;;
    mostrarDatos($url, $parametros, $rutaImg);
}

function mostrarEstado($codEstado, $mensaje)
{
    echo "STATUS: " . $codEstado;
    echo "<br>" . $mensaje;
}


function mostrarDatos($url, $parametros, $rutaImg)
{
    $data = @file_get_contents($url . $parametros);
    $respuesta = json_decode($data);
    $codEstado = substr($http_response_header[0], 9, 3);
    $mensaje = substr($http_response_header[0], 13);
    if ($codEstado == 200) {
        echo "<table border='1'><tr><th>Nombre</th><th>Precio</th><th>Imagen</th></tr>";
        foreach ($respuesta as $producto) {
            echo "<tr><td>" . $producto->nombre . "</td>";
            echo "<td>" . $producto->precio . "</td>";
            echo "<td> <img style='width: 200px;' src='" . $rutaImg . $producto->urlImg . "'></td></tr>";
        }
        echo "</table>";
    } else {
        mostrarEstado($codEstado, $mensaje);
    }
    echo "<a href='index.php'><h3>VOLVER A LA PÁGINA DE CONSULTAS</h3></a>";
}

function pideServicio($url, $datos, $metodo)
{
    $opciones = [
        "http" => [
            "header" => "Content-type: application/x-www-form-urlencoded\r\n",
            "method" => $metodo,
            "content" => http_build_query($datos)
        ],
    ];
    $contexto = stream_context_create($opciones);
    @file_get_contents($url, false, $contexto);
    $codEstado = substr($http_response_header[0], 9, 3);
    $mensaje = substr($http_response_header[0], 13);
    mostrarEstado($codEstado, $mensaje);
}
