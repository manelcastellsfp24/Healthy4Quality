<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>

<?php include __DIR__ . '/../templates/header.php'; ?>

<section class="auth-page">
  <div class="auth-wrap">
    <div class="auth-card">

      <h1 class="auth-title">Iniciar sesión</h1>
      <p class="auth-subtitle">Accede para ver tu perfil y finalizar pedidos.</p>

      <?php if (!empty($_SESSION['error_login'])): ?>
        <div class="auth-alert">
          <?= htmlspecialchars($_SESSION['error_login']) ?>
        </div>
        <?php unset($_SESSION['error_login']); ?>
      <?php endif; ?>

      <form action="index.php?controller=usuario&action=auth" method="POST" class="auth-form">

        <div class="auth-field">
          <label class="auth-label">Email</label>
          <input type="email" name="email" class="auth-input" placeholder="tucorreo@email.com" required>
        </div>

        <div class="auth-field">
          <label class="auth-label">Contraseña</label>
          <input type="password" name="password" class="auth-input" placeholder="••••••••" required>
        </div>

        <button type="submit" class="auth-btn-primary">Entrar</button>

        <div class="auth-divider"></div>

        <p class="auth-small">¿No tienes cuenta?</p>

        <a href="index.php?controller=usuario&action=registro" class="auth-btn-secondary">
          Registrarme
        </a>

      </form>

    </div>
  </div>
</section>

<?php include __DIR__ . '/../templates/footer.php'; ?>
