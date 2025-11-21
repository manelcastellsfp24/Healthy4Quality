<?php
class Database {
    private static $host = "localhost";
    private static $dbname = "Restaurante";
    private static $user = "root";
    private static $password = "tu_contraseña_segura";

    public static function conectar() {
        try {
            $conexion = new PDO(
                "mysql:host=" . self::$host . ";dbname=" . self::$dbname . ";charset=utf8",
                self::$user,
                self::$password
            );
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexion;
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}
?>
