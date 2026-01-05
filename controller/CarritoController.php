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
                "cantidad"    => 1,
                "id_categoria" => $producto["id_categoria"] ?? null

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
    
        if (!isset($_SESSION['usuario'])) {
            die("Debes iniciar sesión para finalizar el pedido.");
        }
    
        $id_usuario = $_SESSION['usuario']['id'];
    
        // Asegurar id_categoria en cada item (por si el carrito venía de antes)
        foreach ($carrito as $k => $item) {
            if (!isset($item['id_categoria']) || $item['id_categoria'] === null || $item['id_categoria'] === '') {
                $prod = Producto::getById($item['id_producto']);
                $carrito[$k]['id_categoria'] = $prod['id_categoria'] ?? null;
                $_SESSION['carrito'] = $carrito;

            }
        }
    
        // Calcular total base
        $total = 0;
        foreach ($carrito as $item) {
            $total += (float)$item['precio'] * (int)$item['cantidad'];
        }
    
        // ===== DESCUENTOS (elige el mejor) =====
        $descuentos = [];
    
        // ⚠️ AJUSTA estos IDs a los de tu BD
        $CAT_BOWLS = 1;
    
        // 1) 3x2 en Bowls (por cada 3 bowls, 1 gratis = el más barato)
        $preciosBowls = [];
        foreach ($carrito as $item) {
            if ((int)($item['id_categoria'] ?? 0) === (int)$CAT_BOWLS) {
                $cant = (int)$item['cantidad'];
                for ($i = 0; $i < $cant; $i++) {
                    $preciosBowls[] = (float)$item['precio'];
                }
            }
        }
    
        $numBowls = count($preciosBowls);
        $gratis = intdiv($numBowls, 3);
    
        if ($gratis > 0) {
            sort($preciosBowls); // más baratos primero
            $desc3x2 = array_sum(array_slice($preciosBowls, 0, $gratis));
            $descuentos['3x2 Bowls'] = $desc3x2;
        }
    
        // 2) Lunch 15% (12:00 - 16:00)
        $hora = (int)date("H");
        if ($hora >= 12 && $hora < 16) {
            $descuentos['Lunch 15%'] = $total * 0.15;
        }
    
        // Elegir descuento mayor
        $descuento = 0;
        $ofertaAplicada = null;
    
        if (!empty($descuentos)) {
            $ofertaAplicada = array_keys($descuentos, max($descuentos))[0];
            $descuento = max($descuentos);
        }
    
        $descuento = round((float)$descuento, 2);
        $total_final = round(max(0, $total - $descuento), 2);
    
        // ✅ Crear pedido CON EL TOTAL FINAL (con descuento aplicado)
        // Si tu Pedido::crear solo acepta 2 parámetros, usa esta línea:
        $id_pedido = Pedido::crear($id_usuario, $total_final);
    
        // Crear líneas
        foreach ($carrito as $item) {
            LineaPedido::crear(
                $id_pedido,
                $item["id_producto"],
                (int)$item["cantidad"],
                (float)$item["precio"]
            );
        }
    
        // Vaciar carrito
        unset($_SESSION['carrito']);
    
        // Variables para la vista resumen
        // (así resumen.php puede mostrarlo)
        // $total = total base
        // $descuento, $total_final, $ofertaAplicada
        require __DIR__ . '/../view/carrito/resumen.php';
    }
    
    
}
