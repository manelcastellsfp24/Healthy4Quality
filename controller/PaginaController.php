<?php
require_once __DIR__ . '/../model/Producto.php';
require_once __DIR__ . '/../model/Oferta.php';

class PaginaController {

    public function home() {
        $productosDestacados = Producto::getDestacados(4);
        $ofertas = Oferta::getActivas();

        require __DIR__ . '/../view/home/home.php';
    }
}

