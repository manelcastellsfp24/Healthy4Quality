<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi perfil</title>
</head>
<body>

<h1>Hola, <?= htmlspecialchars($usuario['nombre']) ?></h1>

<h2>Mis datos</h2>

<form action="index.php?controller=usuario&action=actualizar" method="POST">
    Nombre: <input type="text" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required><br><br>
    Email: <input type="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required><br><br>
    Teléfono: <input type="text" name="telefono" value="<?= htmlspecialchars($usuario['telefono'] ?? '') ?>"><br><br>

    <button type="submit">Guardar cambios</button>
</form>

<hr>

<h2>Último pedido</h2>

<?php if ($ultimoPedido): ?>
    <p>Nº pedido: <strong><?= $ultimoPedido['id_pedido'] ?></strong></p>
    <p>Fecha: <?= $ultimoPedido['fecha'] ?></p>
    <p>Total: <?= number_format($ultimoPedido['total'], 2) ?> €</p>
    <p>Estado: <?= htmlspecialchars($ultimoPedido['estado']) ?></p>
    <a href="index.php?controller=usuario&action=verPedido&id=<?= $ultimoPedido['id_pedido'] ?>">
        Ver detalle
    </a>
<?php else: ?>
    <p>Aún no has realizado ningún pedido.</p>
<?php endif; ?>

<hr>

<h2>Todos mis pedidos</h2>

<?php if (!empty($pedidos)): ?>
    <table border="1" cellpadding="6">
        <tr>
            <th>Nº Pedido</th>
            <th>Fecha</th>
            <th>Total</th>
            <th>Estado</th>
            <th></th>
        </tr>

        <?php foreach ($pedidos as $p): ?>
            <tr>
                <td><?= $p['id_pedido'] ?></td>
                <td><?= $p['fecha'] ?></td>
                <td><?= number_format($p['total'], 2) ?> €</td>
                <td><?= htmlspecialchars($p['estado']) ?></td>
                <td>
                    <a href="index.php?controller=usuario&action=verPedido&id=<?= $p['id_pedido'] ?>">
                        Ver detalle
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>No tienes pedidos todavía.</p>
<?php endif; ?>

<br>
<a href="index.php?controller=producto&action=lista">Volver a productos</a> |
<a href="index.php?controller=usuario&action=logout">Cerrar sesión</a>

</body>
</html>
