<?php
// Carpeta: Unidad12/Ejercicios_12_7/Ejercicio1/Servidor/api_monedas.php
header("Content-Type: application/json; charset=UTF-8");

// Tasa fija: 1 Euro = 166.386 Pesetas
$tasa = 166.386;

if (isset($_GET['cantidad']) && isset($_GET['moneda'])) {
    $cantidad = floatval($_GET['cantidad']);
    $moneda = $_GET['moneda'];
    $resultado = 0;
    $simbolo = "";

    if ($moneda == "EUR") {
        $resultado = $cantidad * $tasa;
        $simbolo = "pts";
    } else {
        $resultado = $cantidad / $tasa;
        $simbolo = "€";
    }

    http_response_code(200);
    echo json_encode([
        "resultado" => number_format($resultado, 2, ',', '.'),
        "simbolo" => $simbolo
    ]);
} else {
    http_response_code(400);
    echo json_encode(["error" => "Faltan parámetros"]);
}