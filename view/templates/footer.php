<?php
$controller = $_GET['controller'] ?? null;
$isHome = (!$controller) || ($controller === 'home');
?>

<?php if (!$isHome): ?>
    </div> <!-- /container (abierto en header.php) -->
<?php endif; ?>

</main>


<footer class="hq-footer">
    <div class="hq-footer-top">
        <div class="container">
            <div class="hq-footer-grid">

                <!-- Columna 1: logo + texto -->
                <div class="hq-footer-col">
                    <div class="hq-footer-brand">
                        <a class="hq-logo" href="index.php">
                            <img src="/Healthy4Quality/assets/img/Logo.svg" alt="Healthy4Quality" class="hq-logo-img">
                        </a>
                    </div>

                    <p class="hq-footer-text">
                        En Healthy 4Quality podrás disfrutar de bowls y postres fitness hechos con
                        ingredientes frescos y pensados para recargar tu día.
                    </p>
                </div>

                <!-- Columna 2: horario -->
                <div class="hq-footer-col">
                    <h3 class="hq-footer-title">Horario restaurante</h3>

                    <ul class="hq-footer-hours">
                        <li>
                            <span class="hq-footer-day">Lunes - a jueves</span>
                            <span class="hq-footer-time">07:00 - 22:30</span>
                        </li>
                        <li>
                            <span class="hq-footer-day">Viernes</span>
                            <span class="hq-footer-time">07:00 - 00:30</span>
                        </li>
                        <li>
                            <span class="hq-footer-day">Sábado</span>
                            <span class="hq-footer-time">09:00 - 00:30</span>
                        </li>
                        <li>
                            <span class="hq-footer-day">Domingo</span>
                            <span class="hq-footer-time">Cerrado</span>
                        </li>
                    </ul>
                </div>

                <!-- Columna 3: iconos -->
                <div class="hq-footer-col hq-footer-icons">
                    <div class="hq-icon-grid">
                        <!-- Arriba -->
                        <a class="hq-icon" href="#" title="Teléfono" aria-label="Teléfono">📞</a>
                        <a class="hq-icon" href="#" title="Ubicación" aria-label="Ubicación">📍</a>
                        <a class="hq-icon" href="#" title="Email" aria-label="Email">✉️</a>
                        <!-- Abajo -->
                        <a class="hq-icon" href="#" title="WhatsApp" aria-label="WhatsApp">💬</a>
                        <a class="hq-icon" href="#" title="Instagram" aria-label="Instagram">📷</a>
                        <a class="hq-icon" href="#" title="Facebook" aria-label="Facebook">f</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="hq-footer-bottom">
        <div class="container">
            <p class="hq-footer-copy mb-0">
                Copyright 2025 © Todos los derechos reservados por Healthy4Quality
            </p>
        </div>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>