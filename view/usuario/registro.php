<?php include __DIR__ . '/../templates/header.php'; ?>

<section class="auth-page">
  <div class="auth-wrap">

    <div class="auth-card">
      <h1 class="auth-title">Crear cuenta</h1>
      <p class="auth-sub">Regístrate para guardar tus pedidos y acceder a tu perfil.</p>

      <?php if (!empty($_SESSION['error_registro'])): ?>
        <div class="alert alert-danger auth-alert">
          <?= htmlspecialchars($_SESSION['error_registro']) ?>
        </div>
        <?php unset($_SESSION['error_registro']); ?>
      <?php endif; ?>

      <form action="index.php?controller=usuario&action=guardarRegistro" method="POST" class="auth-form">

        <label class="auth-label">Nombre</label>
        <input type="text" name="nombre" class="form-control auth-input" placeholder="Tu nombre" required>

        <label class="auth-label mt-3">Email</label>
        <input type="email" name="email" class="form-control auth-input" placeholder="tucorreo@email.com" required>

        <label class="auth-label mt-3">Contraseña</label>
        <input type="password" name="password" class="form-control auth-input" placeholder="••••••••" required>

        <button type="submit" class="auth-btn mt-4">Registrarme</button>

        <div class="auth-footer">
          <span>¿Ya tienes cuenta?</span>
          <a href="index.php?controller=usuario&action=login" class="auth-link">Iniciar sesión</a>
        </div>

      </form>
    </div>

  </div>
</section>

<?php include __DIR__ . '/../templates/footer.php'; ?>

