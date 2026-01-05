<?php
require_once __DIR__ . "/../model/Producto.php";

class ProductoController {

    public function lista() {
        $productos = Producto::getAll();
        require __DIR__ . "/../view/producto/lista.php";
    }
}

class HomeController {
    public function index() {
        $productosDestacados = Producto::getDestacados(4);
        require __DIR__ . "/../view/home.php";
    }
}
?>