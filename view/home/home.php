<?php include __DIR__ . '/../templates/header.php'; ?>

<!-- HERO PRINCIPAL -->
<section id="hero" class="hero-home mb-5">
  <div class="container">
    <div class="row align-items-center hero-inner">

      <!-- TEXTO IZQUIERDA -->
      <div class="col-lg-6 mb-4 mb-lg-0 hero-text">
        <h1 class="display-4 fw-bold mb-3 hero-title">
          Energía que <span class="hero-break">se come</span>
        </h1>

        <p class="lead mb-4">
          Comida saludable con actitud: real, fresca y con el punto justo de intensidad para tu día.
          Preparada para llevar o disfrutar en sala.
        </p>

        <a href="index.php?controller=producto&action=lista"
           class="btn btn-success btn-lg me-2 hero-btn-ver-carta">
          Ver carta
        </a>
      </div>

      <!-- FORMULARIO DERECHA -->
      <div class="col-lg-6 d-flex justify-content-lg-end">
        <div class="hero-card hero-form p-4 p-md-5 rounded-4 shadow-lg">

          <h2 class="h5 fw-bold mb-2 text-white text-center">
            Primera bebida gratuita
          </h2>

          <form>
            <div class="mb-3">
              <input type="text" class="form-control hero-input" placeholder="Nombre*">
            </div>

            <div class="mb-3">
              <input type="email" class="form-control hero-input" placeholder="Email*">
            </div>

            <div class="mb-4">
              <input type="tel" class="form-control hero-input" placeholder="Teléfono*">
            </div>

            <button type="button"
                    onclick="window.location.href='index.php?controller=producto&action=lista'"
                    class="hero-btn-submit w-100">
              Hacer pedido
            </button>
          </form>

        </div>
      </div>

    </div>
  </div>
</section>

<!-- PLATOS DESTACADOS -->
<section id="carta" class="top-platos">
  <div class="container">
    <!-- TÍTULOS -->
    <div class="top-platos-head">
      <div class="top-platos-bg">TOP PLATOS</div>
      <h2 class="top-platos-title">PLATOS DESTACADOS</h2>
    </div>
    <?php if (!empty($productosDestacados)): ?>
      <div class="row g-4">
        <?php foreach ($productosDestacados as $p): ?>
          <div class="col-6 col-lg-3">
            <article class="tp-card">
              <div class="tp-img">
              <?php
$img = $p['imagen'] ?? '';

// Si está vacío -> fallback
if (!$img) {
  $img = '/Healthy4Quality/assets/img/Salmon.png';
}

// Si guardas solo "Salmon.png" o "bowl.jpg"
else if (!str_contains($img, '/')) {
  $img = '/Healthy4Quality/assets/img/' . $img;
}

// Si guardas "assets/img/bowl.jpg"
else if (str_starts_with($img, 'assets/')) {
  $img = '/Healthy4Quality/' . $img;
}

// Si guardas "/assets/img/bowl.jpg"
else if (str_starts_with($img, '/assets/')) {
  $img = '/Healthy4Quality' . $img;
}
?>

<img src="<?= htmlspecialchars($img) ?>"
     alt="<?= htmlspecialchars($p['nombre']) ?>"
     loading="lazy">

              </div>
              <h3 class="tp-name"><?= htmlspecialchars($p['nombre']) ?></h3>
              <p class="tp-desc">
                <?= htmlspecialchars($p['descripcion'] ?? '') ?>
              </p>
            </article>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <p class="text-white-50">No hay productos destacados todavía.</p>
    <?php endif; ?>
  </div>
</section>

<!-- OFERTAS -->
<section id="servicios" class="ofertas-sec">
  <div class="container">

    <div class="ofertas-head">
      <div class="ofertas-bg">DESCUENTOS</div>
      <h2 class="ofertas-title">OFERTAS Y DESCUENTOS</h2>
    </div>

    <div class="ofertas-grid">

      <?php
      // Si no hay ofertas en BD, usamos fallback
      if (empty($ofertas)) {
        $ofertas = [
          ["nombre" => "3X2", "descripcion" => "Compra 3 bowls y paga 2"],
          ["nombre" => "1 bebida gratis", "descripcion" => "En tu primer pedido"],
          ["nombre" => "Healthy lunch 15%", "descripcion" => "Si vienes a la hora del almuerzo toda la carta al 15% de descuento"],
        ];
      }

      $i = 0;
      foreach ($ofertas as $of):
        $i++;

        // rojo - negro - rojo (1 y 3 rojo, 2 negro)
        $claseColor = ($i % 2 === 0) ? "oferta-dark" : "oferta-red";

        $titulo = $of["nombre"] ?? "";
        $texto  = $of["descripcion"] ?? ($of["valor"] ?? "");
      ?>
        <article class="oferta-card <?= $claseColor ?>">
          <h3 class="oferta-big"><?= htmlspecialchars($titulo) ?></h3>
          <p class="oferta-small"><?= htmlspecialchars($texto) ?></p>
        </article>
      <?php endforeach; ?>

    </div>

  </div>
</section>

<!-- Horario Restaurante -->
<section id="horario" class="horario-sec">
  <div class="container">

    <div class="horario-head">
      <div class="horario-bg">HORARIO</div>
      <h2 class="horario-title">HORARIO RESTAURANTE</h2>
      <p class="horario-sub">Todo nuestro horario de lunes a sábado, domingo cerrado</p>
    </div>

    <div class="horario-wrap">
      <table class="horario-table2">
        <thead>
          <tr>
            <th>Lunes</th>
            <th>Martes</th>
            <th>Miércoles</th>
            <th>Jueves</th>
            <th>Viernes</th>
            <th>Sábado</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td><strong>DESAYUNO</strong><br><span>7:00am - 9:00am</span></td>
            <td><strong>DESAYUNO</strong><br><span>7:00am - 9:00am</span></td>
            <td><strong>DESAYUNO</strong><br><span>7:00am - 9:00am</span></td>
            <td><strong>DESAYUNO</strong><br><span>7:00am - 9:00am</span></td>
            <td><strong>DESAYUNO</strong><br><span>7:00am - 9:00am</span></td>
            <td><strong>DESAYUNO</strong><br><span>9:00am - 11:00am</span></td>
          </tr>

          <tr>
            <td><strong>ALMUERZO</strong><br><span>9:00am - 12:00am</span></td>
            <td><strong>ALMUERZO</strong><br><span>9:00am - 12:00am</span></td>
            <td><strong>ALMUERZO</strong><br><span>9:00am - 12:00am</span></td>
            <td><strong>ALMUERZO</strong><br><span>9:00am - 12:00am</span></td>
            <td><strong>ALMUERZO</strong><br><span>9:00am - 12:00am</span></td>
            <td><strong>ALMUERZO</strong><br><span>11:00am - 1:00am</span></td>
          </tr>

          <tr>
            <td><strong>COMIDA</strong><br><span>1:00pm - 4:00pm</span></td>
            <td><strong>COMIDA</strong><br><span>1:00pm - 4:00pm</span></td>
            <td><strong>COMIDA</strong><br><span>1:00pm - 4:00pm</span></td>
            <td><strong>COMIDA</strong><br><span>1:00pm - 4:00pm</span></td>
            <td><strong>COMIDA</strong><br><span>1:00pm - 4:00pm</span></td>
            <td><strong>COMIDA</strong><br><span>1:00pm - 4:00pm</span></td>
          </tr>

          <tr>
            <td><strong>MERIENDA</strong><br><span>5:00pm - 7:00pm</span></td>
            <td><strong>MERIENDA</strong><br><span>5:00pm - 7:00pm</span></td>
            <td><strong>MERIENDA</strong><br><span>5:00pm - 7:00pm</span></td>
            <td><strong>MERIENDA</strong><br><span>5:00pm - 7:00pm</span></td>
            <td><strong>MERIENDA</strong><br><span>5:00pm - 8:00pm</span></td>
            <td><strong>MERIENDA</strong><br><span>5:00pm - 8:00pm</span></td>
          </tr>

          <tr>
            <td><strong>CENA</strong><br><span>8:00pm - 10:30pm</span></td>
            <td><strong>CENA</strong><br><span>8:00pm-10:30pm</span></td>
            <td><strong>CENA</strong><br><span>8:00pm-10:30pm</span></td>
            <td><strong>CENA</strong><br><span>8:00pm-10:30pm</span></td>
            <td><strong>CENA</strong><br><span>9:00pm-12:30pm</span></td>
            <td><strong>CENA</strong><br><span>9:00pm-12:30pm</span></td>
          </tr>
        </tbody>
      </table>
    </div>

  </div>
</section>


<?php include __DIR__ . '/../templates/footer.php'; ?>