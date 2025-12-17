<?php include __DIR__ . '/../templates/header.php'; ?>

<!-- HERO PRINCIPAL -->
<section id="hero" class="hero-home row align-items-center mb-5">

    <div class="col-lg-6 mb-4 mb-lg-0">
        <h1 class="display-4 fw-bold mb-3">
            Energía que se come
        </h1>

        <p class="lead mb-4">
            Bowls, ensaladas y platos saludables para que te cuides sin renunciar al sabor.
        </p>

        <a href="index.php?controller=producto&action=lista" class="btn btn-success btn-lg me-2">
            Ver carta
        </a>

        <a href="index.php?controller=carrito&action=ver" class="btn btn-outline-success btn-lg">
            Ver carrito
        </a>
    </div>

    <!-- TARJETA FORMULARIO DEL HERO -->
    <div class="col-lg-6">
        <div class="hero-card p-4 p-md-5 rounded-4 shadow-sm bg-white">
            <h2 class="h4 fw-bold mb-3">Haz tu pedido</h2>
            <p class="small text-muted mb-3">Primera bebida gratuita con tu primer pedido online.</p>

            <form>
                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" class="form-control" placeholder="Tu nombre">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" placeholder="tucorreo@email.com">
                </div>

                <div class="mb-3">
                    <label class="form-label">Teléfono</label>
                    <input type="tel" class="form-control" placeholder="600 000 000">
                </div>

                <button type="button"
                        onclick="window.location.href='index.php?controller=producto&action=lista'"
                        class="btn btn-success w-100">
                    Hacer pedido
                </button>
            </form>
        </div>
    </div>
</section>

<!-- PLATOS DESTACADOS (DINÁMICO) -->
<section id="carta" class="mb-5">
    <h2 class="h3 fw-bold mb-4">Platos destacados</h2>

    <?php if (!empty($productosDestacados)): ?>
        <div class="row g-4">

            <?php foreach ($productosDestacados as $p): ?>
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm producto-card">
                        <div class="card-body d-flex flex-column">

                            <h3 class="h5 fw-bold mb-2">
                                <?= htmlspecialchars($p['nombre']) ?>
                            </h3>

                            <p class="small flex-grow-1">
                                <?= htmlspecialchars($p['descripcion'] ?? '') ?>
                            </p>

                            <p class="fw-bold text-success mb-3">
                                <?= number_format($p['precio'], 2) ?> €
                            </p>

                            <a href="index.php?controller=carrito&action=add&id=<?= $p['id_producto'] ?>"
                               class="btn btn-success btn-sm mt-auto w-100">
                                Añadir al carrito
                            </a>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    <?php else: ?>
        <p>No hay productos destacados todavía.</p>
    <?php endif; ?>
</section>

<!-- OFERTAS (DINÁMICO) -->
<section id="servicios" class="mb-5">
    <h2 class="h3 fw-bold mb-4">Ofertas y descuentos</h2>

    <?php if (!empty($ofertas)): ?>
        <div class="row g-3">

            <?php foreach ($ofertas as $of): ?>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="oferta-card p-3 rounded-4 h-100">
                        <p class="small text-uppercase fw-bold mb-1 text-muted">
                            <?= htmlspecialchars($of['tipo']) ?>
                        </p>

                        <h3 class="h5 fw-bold mb-1">
                            <?= htmlspecialchars($of['nombre']) ?>
                        </h3>

                        <p class="mb-0">
                            <?= htmlspecialchars($of['valor']) ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    <?php else: ?>
        <p>No hay ofertas activas en este momento.</p>
    <?php endif; ?>
</section>

<!-- HORARIO (ESTÁTICO) -->
<section id="horario" class="mb-5">
    <h2 class="h3 fw-bold mb-4">Horario del restaurante</h2>

    <div class="table-responsive">
        <table class="table table-sm align-middle horario-table">

            <thead class="table-light">
                <tr>
                    <th>Día</th>
                    <th>Desayuno</th>
                    <th>Almuerzo</th>
                    <th>Comida</th>
                    <th>Merienda</th>
                    <th>Cena</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>Lunes - Viernes</td>
                    <td>08:00 - 11:00</td>
                    <td>11:30 - 13:00</td>
                    <td>13:00 - 16:00</td>
                    <td>16:30 - 1

