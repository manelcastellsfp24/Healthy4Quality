<?php include __DIR__ . '/../templates/header.php'; ?>

<section class="mb-4">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h1 class="h2 fw-bold mb-2">Nuestra carta</h1>
            <p class="text-muted mb-0">
                Elige tus bowls, ensaladas y platos favoritos. Puedes añadirlos directamente al carrito.
            </p>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <a href="index.php?controller=carrito&action=ver" class="btn btn-outline-success">
                Ver carrito
            </a>
        </div>
    </div>
</section>

<?php if (!empty($productos)): ?>
    <section class="mb-5">
        <div class="row g-4">
            <?php foreach ($productos as $p): ?>
                <div class="col-sm-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm producto-card">
                        <div class="card-body d-flex flex-column">
                            <h2 class="h5 fw-bold mb-2">
                                <?= htmlspecialchars($p['nombre']) ?>
                            </h2>

                            <?php if (!empty($p['descripcion'])): ?>
                                <p class="small flex-grow-1 mb-2">
                                    <?= htmlspecialchars($p['descripcion']) ?>
                                </p>
                            <?php else: ?>
                                <p class="small flex-grow-1 mb-2 text-muted">
                                    Plato saludable de la casa.
                                </p>
                            <?php endif; ?>

                            <p class="fw-bold text-success fs-5 mb-3">
                                <?= number_format($p['precio'], 2) ?> €
                            </p>

                            <a href="index.php?controller=carrito&action=add&id=<?= $p['id_producto'] ?>"
                               class="btn btn-success w-100 mt-auto">
                                Añadir al carrito
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<?php else: ?>
    <p>No hay productos disponibles en este momento.</p>
<?php endif; ?>

<?php include __DIR__ . '/../templates/footer.php'; ?>


