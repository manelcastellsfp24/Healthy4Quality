<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
</head>
<body>

<h1>Login</h1>

<?php if (!empty($_SESSION['error_login'])): ?>
    <div class="alert alert-danger">
        <?= htmlspecialchars($_SESSION['error_login']) ?>
    </div>
    <?php unset($_SESSION['error_login']); ?>
<?php endif; ?>


<form action="index.php?controller=usuario&action=auth" method="POST">
    Email: <input type="email" name="email" required><br><br>
    Contraseña: <input type="password" name="password" required><br><br>
    <button type="submit">Entrar</button>
</form>
<div class="text-center mt-3">
  <p class="mb-2">¿No tienes cuenta?</p>

    <a href="index.php?controller=usuario&action=registro"
    class="btn btn-outline-danger w-100 fw-bold">
    Registrarme
    </a>

</div>


</body>
</html>