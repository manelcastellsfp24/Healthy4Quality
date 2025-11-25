<?php
require_once __DIR__ . '/../database/conexion.php';

class Usuario {

    public static function crear($nombre, $email, $password) {
        $db = Database::conectar();

        // Encriptar contraseña
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $db->prepare("INSERT INTO Usuario (nombre, email, contraseña, rol)
                             VALUES (?, ?, ?, 'cliente')");
        return $stmt->execute([$nombre, $email, $hash]);
    }

    public static function getByEmail($email) {
        $db = Database::conectar();
        $stmt = $db->prepare("SELECT * FROM Usuario WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>