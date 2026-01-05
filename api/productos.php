<?php
session_start();
header("Content-Type: application/json");

require_once __DIR__ . '/../model/Producto.php';
require_once __DIR__ . '/../model/LogAccion.php';  // modelo de logs

// Solo permitir acceso si el usuario es admin
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    http_response_code(403);
    echo json_encode(["ok" => false, "error" => "Acceso no autorizado (admin requerido)"]);
    exit;
}


$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    echo json_encode(Producto::getAll());
    exit;
}

if ($method === 'POST') {

    $accion = $_POST['accion'] ?? 'crear';

    // id del usuario que está haciendo la acción (si hay sesión)
    $idUsuario = $_SESSION['usuario']['id'] ?? null;

    if ($accion === 'crear') {

        $nombre = $_POST['nombre'] ?? null;
        $precio = $_POST['precio'] ?? null;
        $descripcion = $_POST['descripcion'] ?? null;

        if (!$nombre || !$precio) {
            echo json_encode(["ok" => false, "error" => "Faltan datos"]);
            exit;
        }

        try {
            Producto::crear($nombre, $precio, $descripcion);

            // 👇 registrar log
            LogAccion::registrar(
                $idUsuario,
                "Crear producto",
                "Producto creado: $nombre, precio: $precio"
            );

            echo json_encode(["ok" => true]);
        } catch (Exception $e) {
            echo json_encode(["ok" => false, "error" => $e->getMessage()]);
        }
        exit;
    }

    if ($accion === 'editar') {

        $id          = $_POST['id_producto'] ?? null;
        $nombre      = $_POST['nombre'] ?? null;
        $precio      = $_POST['precio'] ?? null;
        $descripcion = $_POST['descripcion'] ?? null;

        if (!$id || !$nombre || !$precio) {
            echo json_encode(["ok" => false, "error" => "Faltan datos"]);
            exit;
        }

        try {
            Producto::actualizar($id, $nombre, $precio, $descripcion);

            // 👇 registrar log
            LogAccion::registrar(
                $idUsuario,
                "Editar producto",
                "ID: $id, nuevo nombre: $nombre, nuevo precio: $precio"
            );

            echo json_encode(["ok" => true]);
        } catch (Exception $e) {
            echo json_encode(["ok" => false, "error" => $e->getMessage()]);
        }
        exit;
    }

    if ($accion === 'eliminar') {

        $id = $_POST['id_producto'] ?? null;

        if (!$id) {
            echo json_encode(["ok" => false, "error" => "Falta id_producto"]);
            exit;
        }

        try {
            Producto::eliminar($id);

            // 👇 registrar log
            LogAccion::registrar(
                $idUsuario,
                "Eliminar producto",
                "ID producto eliminado: $id"
            );

            echo json_encode(["ok" => true]);
        } catch (Exception $e) {
            echo json_encode(["ok" => false, "error" => $e->getMessage()]);
        }
        exit;
    }
}