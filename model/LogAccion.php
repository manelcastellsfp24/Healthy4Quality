<?php

require_once __DIR__ . '/../database/conexion.php';

class LogAccion {

    public static function registrar($id_usuario, $accion, $detalles = null) {
        $db = Database::conectar();
        $stmt = $db->prepare("
            INSERT INTO LogAccion (id_usuario, accion, detalles)
            VALUES (?, ?, ?)
        ");
        $stmt->execute([$id_usuario, $accion, $detalles]);
    }

    public static function getAll() {
        $db = Database::conectar();
        $sql = "
            SELECT l.*, u.nombre as usuario
            FROM LogAccion l
            LEFT JOIN Usuario u ON l.id_usuario = u.id_usuario
            ORDER BY l.fecha DESC
        ";
        return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}
