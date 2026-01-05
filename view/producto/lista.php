<?php include __DIR__ . '/../templates/header.php'; ?>

<?php
// Agrupar por nombre de categoría
$secciones = [];

if (!empty($productos)) {
    foreach ($productos as $p) {
        $cat = $p['nombre_categoria'] ?? 'Sin categoría';
        $secciones[$cat][] = $p;
    }
}
?>

<section class="carta-hero mb-4">
    <div class="d-flex flex-column flex-lg-row align-items-lg-end justify-content-between gap-3">
        <div>
            <h1 class="carta-title">CARTA</h1>
        </div>
        <a href="index.php?controller=carrito&action=ver" class="btn btn-outline-light carta-btn">
            Ver carrito
        </a>
    </div>
</section>

<?php if (!empty($productos)): ?>

    <?php foreach ($secciones as $nombreSeccion => $items): ?>
        <section class="menu-section">
            <h2 class="menu-section-title"><?= htmlspecialchars($nombreSeccion) ?></h2>

            <div class="menu-grid">
                <?php foreach ($items as $p): ?>
                    <article class="menu-card">
                        <div class="menu-card-img">
                            <?php
                                $imgFile = !empty($p['imagen']) ? $p['imagen'] : 'placeholder.jpg';
                                $imgPath = "/Healthy4Quality/assets/img/" . $imgFile;
                            ?>
                            <img src="<?= htmlspecialchars($imgPath) ?>" alt="<?= htmlspecialchars($p['nombre']) ?>">
                        </div>

                        <div class="menu-card-body">
                            <h3 class="menu-card-name"><?= htmlspecialchars($p['nombre']) ?></h3>

                            <p class="menu-card-desc">
                                <?= htmlspecialchars($p['descripcion'] ?? 'Plato saludable de la casa.') ?>
                            </p>

                            <div class="menu-card-price">
                                <?= number_format((float)$p['precio'], 2) ?>€
                            </div>

                            <div class="qty">
                                <button class="qty-btn" type="button" disabled title="Opcional">–</button>
                                <span class="qty-value">0</span>

                                <a class="qty-btn qty-btn-plus"
                                   href="index.php?controller=carrito&action=add&id=<?= $p['id_producto'] ?>">
                                    +
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endforeach; ?>

<?php else: ?>
    <div class="alert alert-light">No hay productos disponibles en este momento.</div>
<?php endif; ?>

<?php include __DIR__ . '/../templates/footer.php'; ?>



