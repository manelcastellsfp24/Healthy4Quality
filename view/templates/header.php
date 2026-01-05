<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Contar productos del carrito
$carritoCount = 0;
if (!empty($_SESSION['carrito'])) {
    foreach ($_SESSION['carrito'] as $item) {
        $carritoCount += (int)$item['cantidad'];
    }
}

$isLogged = isset($_SESSION['usuario']);
$isAdmin  = $isLogged && ($_SESSION['usuario']['rol'] ?? '') === 'admin';

// Detectar si estamos en HOME (sin controller o controller=home)
$controller = $_GET['controller'] ?? null;
$isHome = (!$controller) || ($controller === 'home');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Healthy4Quality</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tu CSS -->
    <link rel="stylesheet" href="/Healthy4Quality/assets/style.css?v=<?= time() ?>">

</head>
<body>

<header class="hq-header">
    <div class="container">
        <div class="hq-nav">

            <!-- LOGO -->
            <a class="hq-logo" href="index.php">
                <img src="/Healthy4Quality/assets/img/Logo.svg" alt="Healthy4Quality" class="hq-logo-img">
            </a>

            <!-- CTA / ACCIONES -->
            <div class="hq-actions">
                <a class="hq-link" href="index.php?controller=producto&action=lista">Carta</a>
                <!-- Carrito -->
                <a class="hq-cart" href="index.php?controller=carrito&action=ver" title="Carrito">
                    🛒
                    <?php if ($carritoCount > 0): ?>
                        <span class="hq-badge"><?= $carritoCount ?></span>
                    <?php endif; ?>
                </a>

                <?php if ($isLogged): ?>

                    <!-- Dropdown Mi cuenta -->
                    <div class="dropdown">
                        <button class="hq-link dropdown-toggle"
                                type="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">
                            Mi cuenta
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="index.php?controller=usuario&action=perfil">
                                    Perfil
                                </a>
                            </li>

                            <?php if ($isAdmin): ?>
                                <li>
                                    <a class="dropdown-item" href="index.php?controller=admin&action=panel">
                                        Panel Admin
                                    </a>
                                </li>
                            <?php endif; ?>

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <a class="dropdown-item text-danger" href="index.php?controller=usuario&action=logout">
                                    Cerrar sesión
                                </a>
                            </li>
                        </ul>
                    </div>

                <?php else: ?>
                    <a class="hq-link" href="index.php?controller=usuario&action=login">Iniciar sesión</a>
                <?php endif; ?>

                <!-- CTA -->
                <a class="hq-cta" href="index.php?controller=producto&action=lista">Hacer pedido</a>
            </div>
        </div>
    </div>
</header>

<?php if ($isHome): ?>
    <!-- HOME: sin container para permitir banner ancho completo -->
    <main>
<?php else: ?>
    <!-- RESTO PÁGINAS: con container -->
    <main class="py-4">
        <div class="container">
<?php endif; ?>