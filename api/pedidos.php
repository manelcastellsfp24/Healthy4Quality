<?php
session_start();
header("Content-Type: application/json");

require_once __DIR__ . '/../database/conexion.php';

try {
    $db = Database::conectar();

    // Pedidos con nombre de usuario
    $sql = "
        SELECT
            p.id_pedido,
            p.fecha,
            p.total,
            p.estado,
            u.id_usuario,
            u.nombre AS nombre_usuario
        FROM Pedido p
        JOIN Usuario u ON p.id_usuario = u.id_usuario
        ORDER BY p.fecha DESC
    ";

    $stmt = $db->query($sql);
    $pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($pedidos);

} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
