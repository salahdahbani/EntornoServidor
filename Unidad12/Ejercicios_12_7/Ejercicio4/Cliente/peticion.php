<?php
$url="http://localhost/EntornoServidor/Unidad12/Ejercicios_12_7/Ejercicio4/Servidor/consultaAlumnos.php";

if (isset($_REQUEST['filtraGrupo'])) {
    $parametros = "?grupo=" . urlencode($_REQUEST['grupo']); // urlencode por seguridad
    mostrarDatos($url, $parametros);
} else if (isset($_REQUEST['filtraCadena'])) {
    $parametros = "?cadena=" . urlencode($_REQUEST['cadena']);
    mostrarDatos($url, $parametros);         
} else if (isset($_REQUEST['filtrarAsignaturas'])) {
    $parametros = "?nombre=" . urlencode($_REQUEST['nombre']);
    mostrarDatos($url, $parametros);
} else if (isset($_REQUEST['borrar'])) {
    $datos = ["nombre" => $_REQUEST['nombre']];
    pideServicio($url, $datos, "DELETE");
} else if (isset($_REQUEST['cambiarGrupo'])) {
    $datos = ["nombre" => $_REQUEST['nombre'], "curso" => $_REQUEST['curso']];
    pideServicio($url, $datos, "PUT"); // Cambiado UPDATE por PUT
} else if (isset($_REQUEST['matricular'])) {
    $datos = [
        "matricula" => $_REQUEST['matricula'], 
        "codigo_asig" => $_REQUEST['codigo_asig']
    ];
    pideServicio($url, $datos, "POST");
}

function mostrarEstado($codEstado, $mensaje) {
    echo "<div style='padding:10px; border:1px solid #ccc;'>";
    echo "<strong>STATUS:</strong> ".$codEstado;
    echo "<br><strong>MENSAJE:</strong> ".$mensaje;
    echo "</div>";
}

function mostrarDatos($url, $parametros) {
    // Usamos el @ para evitar que PHP imprima errores directamente
    $data = @file_get_contents($url . $parametros);
    $respuesta = json_decode($data);
    
    // Captura segura del estado comprobando si la variable existe
    $codEstado = isset($http_response_header) ? substr($http_response_header[0], 9, 3) : "500";
    $mensaje = isset($http_response_header) ? substr($http_response_header[0], 13) : "Error de conexión";

    if ($codEstado == 200) {
        if (is_array($respuesta) && !empty($respuesta)) {
            if (isset($_REQUEST['filtraCadena']) || isset($_REQUEST['filtraGrupo'])) {
                echo "<table border='1'><tr><th>Nombre</th><th>Apellido</th><th>Curso</th></tr>";
                foreach ($respuesta as $alumno) {
                    echo "<tr><td>".($alumno->nombre ?? '')."</td>";
                    echo "<td>".($alumno->apellido ?? '')."</td>";
                    echo "<td>".($alumno->curso ?? '')."</td></tr>";
                }
                echo "</table>";
            } else if (isset($_REQUEST['filtrarAsignaturas'])) {
                echo "<h2>Asignaturas del Alumno</h2>";
                echo "<table border='1'><tr><th>Código</th><th>Nombre</th></tr>";
                foreach ($respuesta as $asignatura) {
                    echo "<tr><td>".($asignatura->codigo ?? '')."</td>";
                    echo "<td>".($asignatura->nombre ?? '')."</td></tr>";
                }
                echo "</table>";
            }
        } else {
            echo "No se encontraron resultados.";
        }
    } else {
        mostrarEstado($codEstado, $mensaje);
    }
    echo "<br><a href='index.php'><h3>VOLVER A LA PÁGINA DE CONSULTAS</h3></a>";
}

function pideServicio ($url, $datos, $metodo){
    $opciones = [
        "http" => [
            "header" => "Content-type: application/x-www-form-urlencoded\r\n",
            "method" => $metodo,
            "content" => http_build_query($datos),
            "ignore_errors" => true // Para que nos devuelva el status aunque sea 404 o 500
        ],
    ];
    $contexto = stream_context_create($opciones);
    @file_get_contents($url, false, $contexto);
    
    // Comprobación de seguridad para evitar el error de variable nula
    if (isset($http_response_header)) {
        $codEstado = substr($http_response_header[0], 9, 3);
        $mensaje = substr($http_response_header[0], 13);
        mostrarEstado($codEstado, $mensaje);
    } else {
        mostrarEstado("500", "No se pudo obtener respuesta del servidor.");
    }
}
?>