<?php
require_once __DIR__ . '/../model/Usuario.php';
require_once __DIR__ . '/../model/Pedido.php';
require_once __DIR__ . '/../model/LineaPedido.php';

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

            header("Location: index.php?controller=usuario&action=perfil");

        } else {
            echo "Credenciales incorrectas. <a href='index.php?controller=usuario&action=login'>Intentar de nuevo</a>";
        }
    }

    public function logout() {
        unset($_SESSION['usuario']);
        session_destroy();
        header("Location: index.php");
    }

    // PANEL DE USUARIO
    public function perfil() {
        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?controller=usuario&action=login");
            exit;
        }

        $id_usuario = $_SESSION['usuario']['id'];

        // Datos del usuario
        $usuario = Usuario::getById($id_usuario);

        // Pedidos del usuario
        $pedidos = Pedido::getByUsuario($id_usuario);

        // Último pedido
        $ultimoPedido = Pedido::getUltimoByUsuario($id_usuario);

        require __DIR__ . '/../view/usuario/perfil.php';
    }

    // actualizar datos desde el formulario del perfil
    public function actualizar() {
        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?controller=usuario&action=login");
            exit;
        }

        $id       = $_SESSION['usuario']['id'];
        $nombre   = $_POST['nombre'];
        $email    = $_POST['email'];
        $telefono = $_POST['telefono'];

        Usuario::actualizar($id, $nombre, $email, $telefono);

        // actualizar nombre en la sesión
        $_SESSION['usuario']['nombre'] = $nombre;

        header("Location: index.php?controller=usuario&action=perfil");
    }

    // ver detalle de un pedido del usuario
    public function verPedido() {
        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?controller=usuario&action=login");
            exit;
        }

        $id_usuario = $_SESSION['usuario']['id'];
        $id_pedido  = $_GET['id'] ?? null;

        if (!$id_pedido) {
            die("Falta id de pedido.");
        }

        $pedido = Pedido::getById($id_pedido);

        if (!$pedido || $pedido['id_usuario'] != $id_usuario) {
            die("No tienes permiso para ver este pedido.");
        }

        $lineas = LineaPedido::getByPedido($id_pedido);

        require __DIR__ . '/../view/usuario/pedido.php';
    }
}
