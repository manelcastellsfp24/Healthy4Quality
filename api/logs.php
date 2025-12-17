<?php
session_start();
header("Content-Type: application/json");

require_once __DIR__ . '/../model/LogAccion.php';

// Solo admin
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    echo json_encode(["error" => "No autorizado"]);
    exit;
}

$logs = LogAccion::getAll();
echo json_encode($logs);
