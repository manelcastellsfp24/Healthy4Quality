<?php
require_once __DIR__ . '/../database/conexion.php';

class Pedido {

    public static function crear($id_usuario, $total) {
        $db = Database::conectar();
        $stmt = $db->prepare("INSERT INTO Pedido (id_usuario, fecha, total, estado) VALUES (?, NOW(), ?, 'pendiente')");
        $stmt->execute([$id_usuario, $total]);
        return $db->lastInsertId();
    }

    // todos los pedidos de un usuario
    public static function getByUsuario($id_usuario) {
        $db = Database::conectar();
        $stmt = $db->prepare(
            "SELECT * FROM Pedido
             WHERE id_usuario = ?
             ORDER BY fecha DESC"
        );
        $stmt->execute([$id_usuario]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // último pedido de un usuario
    public static function getUltimoByUsuario($id_usuario) {
        $db = Database::conectar();
        $stmt = $db->prepare(
            "SELECT * FROM Pedido
             WHERE id_usuario = ?
             ORDER BY fecha DESC
             LIMIT 1"
        );
        $stmt->execute([$id_usuario]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // un pedido concreto (para ver detalle)
    public static function getById($id_pedido) {
        $db = Database::conectar();
        $stmt = $db->prepare("SELECT * FROM Pedido WHERE id_pedido = ?");
        $stmt->execute([$id_pedido]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>