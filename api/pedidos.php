<?php
session_start();
header("Content-Type: application/json");

require_once __DIR__ . '/../database/conexion.php';
require_once __DIR__ . '/../model/LogAccion.php';

// Solo admins
if (!isset($_SESSION['usuario']) || ($_SESSION['usuario']['rol'] ?? '') !== 'admin') {
    http_response_code(403);
    echo json_encode(["ok" => false, "error" => "Acceso no autorizado (admin requerido)"]);
    exit;
}


$method = $_SERVER['REQUEST_METHOD'];

try {
    $db = Database::conectar();

    if ($method === 'GET') {

        // Listar pedidos con nombre de usuario
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
        exit;
    }

    if ($method === 'POST') {

        $accion = $_POST['accion'] ?? null;

        // id del admin que hace la acción (si hay sesión)
        $idAdmin = $_SESSION['usuario']['id'] ?? null;

        if ($accion === 'actualizar') {
            $id_pedido = $_POST['id_pedido'] ?? null;
            $estado    = $_POST['estado'] ?? null;

            if (!$id_pedido || !$estado) {
                echo json_encode(["ok" => false, "error" => "Faltan datos"]);
                exit;
            }

            $stmt = $db->prepare("UPDATE Pedido SET estado = ? WHERE id_pedido = ?");
            $stmt->execute([$estado, $id_pedido]);

            LogAccion::registrar(
                $idAdmin,
                "Actualizar pedido",
                "Pedido $id_pedido cambiado a estado '$estado'"
            );

            echo json_encode(["ok" => true]);
            exit;
        }

        if ($accion === 'eliminar') {
            $id_pedido = $_POST['id_pedido'] ?? null;

            if (!$id_pedido) {
                echo json_encode(["ok" => false, "error" => "Falta id_pedido"]);
                exit;
            }

            // Primero borrar líneas del pedido por integridad
            $stmt = $db->prepare("DELETE FROM Linea_Pedido WHERE id_pedido = ?");
            $stmt->execute([$id_pedido]);

            // Luego borrar el pedido
            $stmt = $db->prepare("DELETE FROM Pedido WHERE id_pedido = ?");
            $stmt->execute([$id_pedido]);

            LogAccion::registrar(
                $idAdmin,
                "Eliminar pedido",
                "Pedido $id_pedido eliminado"
            );

            echo json_encode(["ok" => true]);
            exit;
        }

        echo json_encode(["ok" => false, "error" => "Acción no válida"]);
        exit;
    }

} catch (Exception $e) {
    echo json_encode(["ok" => false, "error" => $e->getMessage()]);
}

