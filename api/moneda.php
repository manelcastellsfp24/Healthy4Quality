<?php
session_start();
header("Content-Type: application/json");

// Solo admins
if (!isset($_SESSION['usuario']) || ($_SESSION['usuario']['rol'] ?? '') !== 'admin') {
    http_response_code(403);
    echo json_encode([
        "ok" => false,
        "error" => "Acceso no autorizado (admin requerido)"
    ]);
    exit;
}

// API KEY
$apiKey = "fca_live_91V8jIwQbCxVbEkNtlFuUAt1jm1yXKgjIIBa1Hvw";

$base = "EUR";
// Monedas a convertir
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

// Devolvemos directamente la respuesta de la API externa
echo $response;
