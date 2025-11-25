<?php
require_once __DIR__ . '/../model/Producto.php';
require_once __DIR__ . '/../model/Pedido.php';
require_once __DIR__ . '/../model/LineaPedido.php';

class CarritoController {

    public function add() {
        $id = $_GET['id'] ?? null;
        if (!$id) die("Falta id de producto.");

        $producto = Producto::getById($id);
        if (!$producto) die("Producto no encontrado.");

        // Si no hay carrito, lo creamos
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }

        // Si ya está, sumamos cantidad
        if (isset($_SESSION['carrito'][$id])) {
            $_SESSION['carrito'][$id]['cantidad']++;
        } else {
            $_SESSION['carrito'][$id] = [
                "id_producto" => $producto["id_producto"],
                "nombre"      => $producto["nombre"],
                "precio"      => $producto["precio"],
                "cantidad"    => 1
            ];
        }

        header("Location: index.php?controller=carrito&action=ver");
        exit;
    }

    public function ver() {
        $carrito = $_SESSION['carrito'] ?? [];
        require __DIR__ . '/../view/carrito/ver.php';
    }

    public function eliminar() {
        $id = $_GET['id'] ?? null;
        if ($id && isset($_SESSION['carrito'][$id])) {
            unset($_SESSION['carrito'][$id]);
        }
        header("Location: index.php?controller=carrito&action=ver");
        exit;
    }

    public function vaciar() {
        unset($_SESSION['carrito']);
        header("Location: index.php?controller=carrito&action=ver");
        exit;
    }

    public function finalizar() {
        $carrito = $_SESSION['carrito'] ?? [];
        if (empty($carrito)) die("Carrito vacío.");

        $id_usuario = $_SESSION['usuario']['id'];


        // Calcular total
        $total = 0;
        foreach ($carrito as $item) {
            $total += $item["precio"] * $item["cantidad"];
        }

        // Crear pedido
        $id_pedido = Pedido::crear($id_usuario, $total);

        // Crear líneas
        foreach ($carrito as $item) {
            LineaPedido::crear(
                $id_pedido,
                $item["id_producto"],
                $item["cantidad"],
                $item["precio"]
            );
        }

        // Vaciar carrito
        unset($_SESSION['carrito']);

        // Mostrar resumen
        require __DIR__ . '/../view/carrito/resumen.php';
    }
}
