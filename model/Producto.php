<?php
require_once __DIR__ . "/../database/conexion.php";

class Producto {

    public static function getAll() {
        $db = Database::conectar();
        $sql = $db->query("SELECT * FROM Producto");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}
