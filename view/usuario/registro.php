<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
</head>
<body>

<h1>Registro de usuario</h1>

<form action="index.php?controller=usuario&action=save" method="POST">
    Nombre: <input type="text" name="nombre" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Contraseña: <input type="password" name="password" required><br><br>
    <button type="submit">Registrarse</button>
</form>

</body>
</html>
