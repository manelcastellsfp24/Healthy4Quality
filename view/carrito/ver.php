<?php include __DIR__ . '/../templates/header.php'; ?>

<div class="carrito-page">

<?php
// Por si el controlador no pasa variables, intentamos leer de sesión
$carrito = $carrito ?? ($_SESSION['carrito'] ?? []);
?>

<section class="mb-4">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h1 class="h2 fw-bold mb-2">Tu carrito</h1>
            <p class="text-muted mb-0">
                Revisa los productos antes de confirmar tu pedido.
            </p>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <a href="index.php?controller=producto&action=lista" class="btn carrito-btn-seguir">
                Seguir comprando
            </a>

        </div>
    </div>
</section>

<?php if (!empty($carrito)): ?>

    <?php
    $total = 0;
    foreach ($carrito as $item) {
        $total += $item['precio'] * $item['cantidad'];
    }
    ?>

    <section class="mb-5">
        <div class="row">
            <!-- LISTA DE PRODUCTOS -->
            <div class="col-lg-8 mb-4 mb-lg-0">
                <div class="card border-0 shadow-sm carrito-card">
                    <div class="card-body">
                        <h2 class="h5 fw-bold mb-3">Productos en tu pedido</h2>

                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Producto</th>
                                        <th class="text-center">Cantidad</th>
                                        <th class="text-end">Precio</th>
                                        <th class="text-end">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($carrito as $item): ?>
                                        <?php $subtotal = $item['precio'] * $item['cantidad']; ?>
                                        <tr>
                                            <td><strong><?= htmlspecialchars($item['nombre']) ?></strong></td>
                                            <td class="text-center"><?= (int)$item['cantidad'] ?></td>
                                            <td class="text-end"><?= number_format($item['precio'], 2) ?> €</td>
                                            <td class="text-end"><?= number_format($subtotal, 2) ?> €</td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3 d-flex justify-content-between">
                            <a href="index.php?controller=carrito&action=vaciar"
                               class="btn btn-outline-danger btn-sm">
                                Vaciar carrito
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RESUMEN DEL PEDIDO -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm resumen-carrito-card">
                    <div class="card-body">
                        <h2 class="h5 fw-bold mb-3">Resumen</h2>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span><?= number_format($total, 2) ?> €</span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between mb-3">
                            <strong>Total</strong>
                            <strong><?= number_format($total, 2) ?> €</strong>
                        </div>

                        <a href="index.php?controller=carrito&action=finalizar"
                            class="btn carrito-btn-finalizar w-100 mb-2">
                            Finalizar pedido
                        </a>

                        <p class="small text-muted mb-0">
                            Al finalizar el pedido, se guardará en tu historial y podrás verlo desde tu perfil.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php else: ?>

    <section class="mb-5">
        <div class="alert alert-info">
            Tu carrito está vacío. Añade productos desde la carta.
        </div>
    </section>

<?php endif; ?>

</div>

<?php include __DIR__ . '/../templates/footer.php'; ?>


