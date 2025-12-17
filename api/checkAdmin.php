<?php
session_start();

header("Content-Type: application/json");

if (!isset($_SESSION['usuario'])) {
    echo json_encode(["ok" => false, "error" => "no_auth"]);
    exit;
}

if ($_SESSION['usuario']['rol'] !== 'admin') {
    echo json_encode(["ok" => false, "error" => "no_admin"]);
    exit;
}

echo json_encode(["ok" => true]);
