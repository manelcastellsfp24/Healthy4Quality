<?php
session_start();
header("Content-Type: application/json");

require_once __DIR__ . '/../database/conexion.php';

// Solo admins
if (!isset($_SESSION['usuario']) || ($_SESSION['usuario']['rol'] ?? '') !== 'admin') {
    http_response_code(403);
    echo json_encode(["ok" => false, "error" => "Acceso no autorizado (admin requerido)"]);
    exit;
}

$db = Database::conectar();

$stmt = $db->query("SELECT * FROM Log ORDER BY fecha DESC");
$logs = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($logs);