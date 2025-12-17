<?php
header("Content-Type: application/json");

//AQUÍ MI API KEY
$apiKey = "fca_live_91V8jIwQbCxVbEkNtlFuUAt1jm1yXKgjIIBa1Hvw";

$base = "EUR";
// Monedas a convertir (puedes añadir más)
$currencies = "USD,GBP,JPY";

// URL de la API externa
$url = "https://api.freecurrencyapi.com/v1/latest"
     . "?apikey=" . urlencode($apiKey)
     . "&base_currency=" . urlencode($base)
     . "&currencies=" . urlencode($currencies);

$response = @file_get_contents($url);

if ($response === false) {
    echo json_encode(["error" => "No se pudo obtener datos de la API externa"]);
    exit;
}

// Simplemente devolvemos lo que nos da la API externa
echo $response;
