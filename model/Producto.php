<?php
require_once __DIR__ . "/../database/conexion.php";

class Producto {

    public static function getAll() {
        $db = Database::conectar();

        $sql = "SELECT p.*, c.nombre AS nombre_categoria
                FROM Producto p
                LEFT JOIN Categoria c ON p.id_categoria = c.id_categoria
                ORDER BY
                    CASE c.nombre
                        WHEN 'Bebidas'   THEN 1
                        WHEN 'Entrantes' THEN 2
                        WHEN 'Bowls'     THEN 3
                        WHEN 'Postres'   THEN 4
                        ELSE 99
                    END,
                    p.nombre";
    
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function getById($id) {
        $db = Database::conectar();
        $stmt = $db->prepare("SELECT * FROM Producto WHERE id_producto = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    

    public static function crear($nombre, $precio, $descripcion) {
        $db = Database::conectar();
        $stmt = $db->prepare("INSERT INTO Producto (nombre, precio, descripcion) VALUES (?, ?, ?)");
        $stmt->execute([$nombre, $precio, $descripcion]);
    }

    public static function actualizar($id, $nombre, $precio, $descripcion) {
        $db = Database::conectar();
        $stmt = $db->prepare(
            "UPDATE Producto
             SET nombre = ?, precio = ?, descripcion = ?
             WHERE id_producto = ?"
        );
        $stmt->execute([$nombre, $precio, $descripcion, $id]);
    }
    
    public static function eliminar($id) {
        $db = Database::conectar();
        $stmt = $db->prepare("DELETE FROM Producto WHERE id_producto = ?");
        $stmt->execute([$id]);
    }

    public static function getDestacados() {
        $db = Database::conectar();
    
        //4 destacados
        $ids = [1, 9, 10, 11];
    
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
    
        $stmt = $db->prepare("
            SELECT id_producto, nombre, descripcion, imagen
            FROM Producto
            WHERE id_producto IN ($placeholders)
        ");
        $stmt->execute($ids);
    
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Mantener el orden EXACTO que en $ids
        usort($productos, function($a, $b) use ($ids){
            return array_search($a['id_producto'], $ids) <=> array_search($b['id_producto'], $ids);
        });
    
        return $productos;
    }
    
    
}
