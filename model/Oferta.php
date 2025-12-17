<?php
require_once __DIR__ . '/../database/conexion.php';

class Oferta {

    public static function getActivas() {
        $db = Database::conectar();

        // Si tienes una columna "activa", puedes añadir WHERE activa = 1
        $sql = "SELECT id_oferta, nombre, tipo, valor 
                FROM Oferta
                ORDER BY id_oferta ASC";
        $stmt = $db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
