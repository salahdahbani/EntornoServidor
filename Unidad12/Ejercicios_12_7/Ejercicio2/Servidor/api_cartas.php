<?php
header("Content-Type: application/json; charset=UTF-8");

if (isset($_GET['numero'])) {
    $cantidadSolicitada = intval($_GET['numero']);

    // Validación según el enunciado
    if ($cantidadSolicitada < 1 || $cantidadSolicitada > 40) {
        http_response_code(400);
        echo json_encode(["error" => "El número debe estar entre 1 y 40"]);
        exit;
    }

    $palos = ["Oros", "Copas", "Espadas", "Bastos"];
    $figuras = ["1", "2", "3", "4", "5", "6", "7", "Sota", "Caballo", "Rey"];
    
    $mazoResultado = [];

    // Bucle para obtener cartas hasta alcanzar la cantidad solicitada
    while (count($mazoResultado) < $cantidadSolicitada) {
        // Generamos una carta aleatoria
        $paloAzar = $palos[rand(0, 3)];
        $figuraAzar = $figuras[rand(0, 9)];
        
        $nuevaCarta = [
            "figura" => $figuraAzar,
            "palo" => $paloAzar
        ];

        // COMPROBACIÓN: ¿Está la carta ya en el array?
        // Usamos in_array para comparar el objeto/array de la carta
        if (!in_array($nuevaCarta, $mazoResultado)) {
            $mazoResultado[] = $nuevaCarta; // Si no está, la añadimos
        }
    }

    http_response_code(200);
    echo json_encode($mazoResultado);
} else {
    http_response_code(400);
    echo json_encode(["error" => "Falta el parámetro 'numero'"]);
}