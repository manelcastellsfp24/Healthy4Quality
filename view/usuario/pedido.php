<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle pedido <?= $pedido['id_pedido'] ?></title>
</head>
<body>

<h1>Detalle del pedido #<?= $pedido['id_pedido'] ?></h1>

<p>Fecha: <?= $pedido['fecha'] ?></p>
<p>Estado: <?= htmlspecialchars($pedido['estado']) ?></p>
<p>Total: <?= number_format($pedido['total'], 2) ?> €</p>

<h2>Productos</h2>

<?php if (!empty($lineas)): ?>
    <table border="1" cellpadding="6">
        <tr>
            <th>Producto</th>
            <th>Precio unitario</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
        </tr>
        <?php foreach ($lineas as $l): ?>
            <?php $sub = $l['precio_unitario'] * $l['cantidad']; ?>
            <tr>
                <td><?= htmlspecialchars($l['nombre']) ?></td>
                <td><?= number_format($l['precio_unitario'], 2) ?> €</td>
                <td><?= $l['cantidad'] ?></td>
                <td><?= number_format($sub, 2) ?> €</td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>Este pedido no tiene líneas.</p>
<?php endif; ?>

<br>
<a href="index.php?controller=usuario&action=perfil">Volver a mi perfil</a>

</body>
</html>
