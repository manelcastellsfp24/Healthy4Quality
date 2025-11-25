<?php
require_once __DIR__ . '/../database/conexion.php';

class Pedido {

    public static function crear($id_usuario, $total) {
        $db = Database::conectar();
        $stmt = $db->prepare("INSERT INTO Pedido (id_usuario, fecha, total, estado) VALUES (?, NOW(), ?, 'pendiente')");
        $stmt->execute([$id_usuario, $total]);
        return $db->lastInsertId();
    }
}
?>