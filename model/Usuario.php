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

    // obtener por id
    public static function getById($id) {
        $db = Database::conectar();
        $stmt = $db->prepare("SELECT * FROM Usuario WHERE id_usuario = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // actualizar datos básicos
    public static function actualizar($id, $nombre, $email, $telefono) {
        $db = Database::conectar();
        $stmt = $db->prepare(
            "UPDATE Usuario
             SET nombre = ?, email = ?, telefono = ?
             WHERE id_usuario = ?"
        );
        return $stmt->execute([$nombre, $email, $telefono, $id]);
    }
}
?>