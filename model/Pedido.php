<?php
require_once __DIR__ . '/../database/conexion.php';

class Pedido {

    // Crear pedido (desde carrito)
    public static function crear($id_usuario, $total, $descuento = 0, $total_final = null, $oferta = null) {
        $db = Database::conectar();
    
        if ($total_final === null) {
            $total_final = max(0, $total - $descuento);
        }
    
        $stmt = $db->prepare("
            INSERT INTO Pedido (id_usuario, fecha, total, descuento, total_final, estado, oferta_aplicada)
            VALUES (?, NOW(), ?, ?, ?, 'pendiente', ?)
        ");
        $stmt->execute([$id_usuario, $total, $descuento, $total_final, $oferta]);
    
        return $db->lastInsertId();
    }
    

    // Obtener todos los pedidos de un usuario (para el perfil)
    public static function getByUsuario($id_usuario) {
        $db = Database::conectar();
        $stmt = $db->prepare("
            SELECT id_pedido, fecha, total, estado
            FROM Pedido
            WHERE id_usuario = ?
            ORDER BY fecha DESC
        ");
        $stmt->execute([$id_usuario]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Último pedido del usuario (por si quieres mostrarlo en home/perfil)
    public static function getUltimoByUsuario($id_usuario) {
        $db = Database::conectar();
        $stmt = $db->prepare("
            SELECT *
            FROM Pedido
            WHERE id_usuario = ?
            ORDER BY fecha DESC
            LIMIT 1
        ");
        $stmt->execute([$id_usuario]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Obtener un pedido por ID (para ver detalle)
    public static function getById($id_pedido) {
        $db = Database::conectar();
        $stmt = $db->prepare("
            SELECT *
            FROM Pedido
            WHERE id_pedido = ?
        ");
        $stmt->execute([$id_pedido]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // -------------------------------
    // NUEVO: Listar pedidos para admin
    // -------------------------------
    public static function getAll() {
        $db = Database::conectar();

        // Incluimos JOIN para mostrar el nombre del usuario
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
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // -------------------------------
    // NUEVO: Cambiar estado del pedido
    // -------------------------------
    public static function actualizarEstado($id_pedido, $estado) {
        $db = Database::conectar();

        $stmt = $db->prepare("
            UPDATE Pedido
            SET estado = ?
            WHERE id_pedido = ?
        ");
        return $stmt->execute([$estado, $id_pedido]);
    }

    // -------------------------------
    // Eliminar un pedido y sus líneas
    // -------------------------------
    public static function eliminar($id_pedido) {
        $db = Database::conectar();

        // Primero borrar líneas del pedido
        $stmt = $db->prepare("
            DELETE FROM Linea_Pedido
            WHERE id_pedido = ?
        ");
        $stmt->execute([$id_pedido]);

        // Luego borrar el pedido
        $stmt = $db->prepare("
            DELETE FROM Pedido
            WHERE id_pedido = ?
        ");
        return $stmt->execute([$id_pedido]);
    }
}
?>