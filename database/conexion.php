<?php

class Database
{
    public static function conectar()
    {
        $host = "sql213.infinityfree.com";
        $db   = "if0_40855339_healthy4quality";
        $user = "if0_40855339";
        $pass = "c6enqeBFiJVZFiQ"; // password del vPanel

        try {
            return new PDO(
                "mysql:host=$host;port=3306;dbname=$db;charset=utf8mb4",
                $user,
                $pass,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}



