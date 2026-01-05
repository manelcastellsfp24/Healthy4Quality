<?php include __DIR__ . '/../templates/header.php'; ?>

<section class="mb-5">
  <div class="card border-0 shadow-sm p-4 rounded-4">
    <h1 class="h3 fw-bold mb-3">✅ Pedido realizado correctamente</h1>

    <p>Tu número de pedido es: <strong><?= (int)$id_pedido ?></strong></p>

    <p><strong>Total:</strong> <?= number_format((float)$total, 2) ?> €</p>

    <?php if (!empty($descuento) && $descuento > 0): ?>
      <p class="text-success"><strong>Descuento:</strong> -<?= number_format((float)$descuento, 2) ?> €</p>
      <p><strong>Oferta aplicada:</strong> <?= htmlspecialchars($ofertaAplicada) ?></p>
      <p class="fs-5"><strong>Total pagado:</strong> <?= number_format((float)$total_final, 2) ?> €</p>
    <?php else: ?>
      <p class="fs-5"><strong>Total pagado:</strong> <?= number_format((float)$total_final, 2) ?> €</p>
    <?php endif; ?>

    <a class="btn btn-success" href="index.php?controller=producto&action=lista">Volver a productos</a>
  </div>
</section>

<?php include __DIR__ . '/../templates/footer.php'; ?>
