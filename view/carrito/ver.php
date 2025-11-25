<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito</title>
</head>
<body>

<h1>Tu carrito</h1>

<?php if (empty($carrito)): ?>
    <p>Carrito vacío.</p>
    <a href="index.php?controller=producto&action=lista">Volver a productos</a>
<?php else: ?>

    <table border="1" cellpadding="6">
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
            <th>Acción</th>
        </tr>

        <?php $total = 0; ?>
        <?php foreach ($carrito as $item): ?>
            <?php $subtotal = $item["precio"] * $item["cantidad"]; ?>
            <?php $total += $subtotal; ?>

            <tr>
                <td><?= htmlspecialchars($item["nombre"]) ?></td>
                <td><?= number_format($item["precio"], 2) ?> €</td>
                <td><?= $item["cantidad"] ?></td>
                <td><?= number_format($subtotal, 2) ?> €</td>
                <td>
                    <a href="index.php?controller=carrito&action=eliminar&id=<?= $item["id_producto"] ?>">
                        Quitar
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>

        <tr>
            <td colspan="3"><strong>Total</strong></td>
            <td colspan="2"><strong><?= number_format($total, 2) ?> €</strong></td>
        </tr>
    </table>

    <br>

    <a href="index.php?controller=carrito&action=vaciar">Vaciar carrito</a>
    |
    <a href="index.php?controller=carrito&action=finalizar">Finalizar pedido</a>

<?php endif; ?>

</body>
</html>
