<?php
// Incluimos el estilo aquí también para que los resultados se vean bien
echo "<link rel='stylesheet' href='estilos.css'>";

function mostrarPeliculas($url) {
    $data = @file_get_contents($url);
    $codEstado = substr($http_response_header[0], 9, 3);
    
    if ($codEstado == 200) {
        $respuesta = json_decode($data, true);
        
        if (count($respuesta['results']) > 0) {
            echo "<div class='contenedor-flex'>";
            
            foreach ($respuesta['results'] as $peli) {
                if (isset($peli['poster_path']) && !empty($peli['poster_path'])) {
                    $poster = "https://image.tmdb.org/t/p/w500" . $peli['poster_path'];
                } else {
                    $poster = "https://via.placeholder.com/300x450?text=Sin+Poster";
                }
                echo "<div class='tarjeta-peli'>";
                echo "<img src='$poster'>";
                echo "<h4>" . $peli['title'] . "</h4>";
                echo "<p class='nota'> " . $peli['vote_average'] . "</p>";
                echo "<p class='anio'>Lanzamiento: " . substr($peli['release_date'], 0, 4) . "</p>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "<h2>No hay resultados.</h2>";
        }
    } else {
        echo "<h2>Error $codEstado: Revisa tu API Key.</h2>";
    }
}

if (isset($_REQUEST['buscar'])) {
    $apiKey = "16b30a205b13af5f923fef4be786d182"; 
    $busqueda = urlencode($_REQUEST['busqueda']);
    $anio = $_REQUEST['anio'];
    $genero = $_REQUEST['genero'];

    if (!empty($busqueda)) {
        $url = "https://api.themoviedb.org/3/search/movie?api_key=" . $apiKey . "&language=es&query=" . $busqueda . "&primary_release_year=" . $anio;
    } else {
        $url = "https://api.themoviedb.org/3/discover/movie?api_key=" . $apiKey . "&language=es&with_genres=$genero&primary_release_year=" . $anio . "&sort_by=popularity.desc";
    }

    mostrarPeliculas($url);
    echo "<br><div style='text-align:center'><a href='index.php' style='color:white'>VOLVER AL BUSCADOR</a></div>";
}
?>