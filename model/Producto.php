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
}
