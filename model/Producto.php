<?php
require_once __DIR__ . "/../database/conexion.php";

class Producto {

    public static function getAll() {
        $db = Database::conectar();
        $sql = $db->query("SELECT id_producto, nombre, descripcion, precio FROM Producto");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $db = Database::conectar();
        $stmt = $db->prepare("SELECT id_producto, nombre, descripcion, precio FROM Producto WHERE id_producto = ?");
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
    
    public static function getDestacados($limite = 4) {
        $db = Database::conectar();
    
        $sql = "SELECT id_producto, nombre, descripcion, precio 
                FROM Producto
                ORDER BY id_producto ASC
                LIMIT ?";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(1, (int)$limite, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
}
