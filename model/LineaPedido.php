<?php
require_once __DIR__ . '/../database/conexion.php';

class LineaPedido {

    public static function crear($id_pedido, $id_producto, $cantidad, $precio_unitario) {
        $db = Database::conectar();
        $stmt = $db->prepare("
            INSERT INTO Linea_Pedido (id_pedido, id_producto, cantidad, precio_unitario)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([$id_pedido, $id_producto, $cantidad, $precio_unitario]);
    }

    // líneas de un pedido
    public static function getByPedido($id_pedido) {
        $db = Database::conectar();
        $stmt = $db->prepare(
            "SELECT lp.*, p.nombre
             FROM Linea_Pedido lp
             JOIN Producto p ON lp.id_producto = p.id_producto
             WHERE lp.id_pedido = ?"
        );
        $stmt->execute([$id_pedido]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>