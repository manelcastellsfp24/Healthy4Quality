<?php include __DIR__ . '/../templates/header.php'; ?>

<section class="pedido-ok-sec">
  <div class="container">

    <div class="pedido-ok-card">
      <h1 class="pedido-ok-title">
        ✅ Pedido realizado correctamente
      </h1>

      <p class="pedido-ok-line">
        Tu número de pedido es: <strong>#<?= (int)$id_pedido ?></strong>
      </p>

      <div class="pedido-ok-info">
        <div class="pedido-ok-row">
          <span>Total</span>
          <strong><?= number_format((float)$total, 2) ?> €</strong>
        </div>

        <?php if (!empty($descuento) && (float)$descuento > 0): ?>
          <div class="pedido-ok-row pedido-ok-row-desc">
            <span>Descuento</span>
            <strong>-<?= number_format((float)$descuento, 2) ?> €</strong>
          </div>
        <?php endif; ?>

        <?php if (!empty($oferta_aplicada)): ?>
          <div class="pedido-ok-row">
            <span>Oferta aplicada</span>
            <strong><?= htmlspecialchars($oferta_aplicada) ?></strong>
          </div>
        <?php endif; ?>

        <?php
          // Si tu controlador ya calcula $total_pagado, lo usamos.
          // Si no, lo calculamos con total - descuento.
          $total_pagado = $total_pagado ?? ((float)$total - (float)($descuento ?? 0));
        ?>

        <hr class="pedido-ok-hr">

        <div class="pedido-ok-row pedido-ok-row-total">
          <span>Total pagado</span>
          <strong><?= number_format((float)$total_pagado, 2) ?> €</strong>
        </div>
      </div>

      <a href="index.php?controller=producto&action=lista" class="pedido-ok-btn">
        Volver a productos
      </a>
    </div>

  </div>
</section>

<?php include __DIR__ . '/../templates/footer.php'; ?>

