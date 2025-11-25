<?php
require_once __DIR__ . '/../model/Usuario.php';

class UsuarioController {

    public function registro() {
        require __DIR__ . '/../view/usuario/registro.php';
    }

    public function save() {
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        Usuario::crear($nombre, $email, $password);

        echo "Usuario registrado. <a href='index.php?controller=usuario&action=login'>Iniciar sesión</a>";
    }

    public function login() {
        require __DIR__ . '/../view/usuario/login.php';
    }

    public function auth() {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $usuario = Usuario::getByEmail($email);

        if ($usuario && password_verify($password, $usuario['contraseña'])) {

            $_SESSION['usuario'] = [
                "id" => $usuario['id_usuario'],
                "nombre" => $usuario['nombre'],
                "rol" => $usuario['rol']
            ];

            header("Location: index.php?controller=producto&action=lista");
        } else {
            echo "Credenciales incorrectas. <a href='index.php?controller=usuario&action=login'>Intentar de nuevo</a>";
        }
    }

    public function logout() {
        unset($_SESSION['usuario']);
        session_destroy();
        header("Location: index.php");
    }
}
