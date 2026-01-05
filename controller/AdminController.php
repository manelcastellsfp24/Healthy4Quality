<?php
class AdminController {

    public function panel() {
        // Solo admins
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
            header("Location: index.php?controller=usuario&action=login");
            exit;
        }

        require __DIR__ . '/../view/admin/panel.php';
    }
}
