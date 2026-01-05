<?php
require_once __DIR__ . '/../model/Usuario.php';
require_once __DIR__ . '/../model/Pedido.php';
require_once __DIR__ . '/../model/LineaPedido.php';

class UsuarioController {

    public function registro() {
        require __DIR__ . '/../view/usuario/registro.php';
    }

    public function save() {
        $nombre   = $_POST['nombre']   ?? '';
        $email    = $_POST['email']    ?? '';
        $password = $_POST['password'] ?? '';

        if ($nombre === '' || $email === '' || $password === '') {
            echo "Faltan datos. <a href='index.php?controller=usuario&action=registro'>Volver</a>";
            return;
        }

        Usuario::crear($nombre, $email, $password);

        echo "Usuario registrado. <a href='index.php?controller=usuario&action=login'>Iniciar sesión</a>";
    }

    public function login() {
        require __DIR__ . '/../view/usuario/login.php';
    }

    public function auth() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?controller=usuario&action=login");
            exit;
        }
    
        $email    = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
    
        if ($email === '' || $password === '') {
            $_SESSION['error_login'] = "Has d'introduir l'email i la contrasenya.";
            header("Location: index.php?controller=usuario&action=login");
            exit;
        }
    
        $usuario = Usuario::getByEmail($email);
    
        if ($usuario && password_verify($password, $usuario['contraseña'])) {
    
            $_SESSION['usuario'] = [
                "id"     => $usuario['id_usuario'],
                "nombre" => $usuario['nombre'],
                "rol"    => $usuario['rol']
            ];
    
            unset($_SESSION['error_login']);
    
            header("Location: index.php?controller=usuario&action=perfil");
            exit;
    
        } else {
            $_SESSION['error_login'] = "Credenciales incorrectas.";
            header("Location: index.php?controller=usuario&action=login");
            exit;
        }
    }
    
    

    public function logout() {
        unset($_SESSION['usuario']);
        session_destroy();
        header("Location: index.php");
        exit;
    }

    // PANEL DE USUARIO: PERFIL
    public function perfil() {
        // Comprobar login
        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?controller=usuario&action=login");
            exit;
        }

        $id_usuario = $_SESSION['usuario']['id'];

        // Cargar datos del usuario
        $usuarioDatos = Usuario::getById($id_usuario);

        // Cargar pedidos del usuario
        $pedidosUsuario = Pedido::getByUsuario($id_usuario);

        require __DIR__ . '/../view/usuario/perfil.php';
    }

    // ACTUALIZAR DATOS DESDE EL FORMULARIO DEL PERFIL
    public function actualizarPerfil() {
        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?controller=usuario&action=login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?controller=usuario&action=perfil");
            exit;
        }

        $id       = $_SESSION['usuario']['id'];
        $nombre   = $_POST['nombre']   ?? '';
        $email    = $_POST['email']    ?? '';
        $telefono = $_POST['telefono'] ?? '';

        if ($nombre === '' || $email === '') {
            header("Location: index.php?controller=usuario&action=perfil");
            exit;
        }

        Usuario::actualizar($id, $nombre, $email, $telefono);

        // actualizar nombre en la sesión
        $_SESSION['usuario']['nombre'] = $nombre;

        header("Location: index.php?controller=usuario&action=perfil");
        exit;
    }

    // VER DETALLE DE UN PEDIDO DEL USUARIO
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

