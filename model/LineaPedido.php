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
}
?>