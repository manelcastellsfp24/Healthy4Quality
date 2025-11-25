<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
</head>
<body>

<h1>Login</h1>

<form action="index.php?controller=usuario&action=auth" method="POST">
    Email: <input type="email" name="email" required><br><br>
    Contraseña: <input type="password" name="password" required><br><br>
    <button type="submit">Entrar</button>
</form>

</body>
</html>