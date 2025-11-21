<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carta de productos</title>
</head>
<body>
    <h1>Productos disponibles</h1>

    <?php if (!empty($productos)): ?>
        <ul>
            <?php foreach ($productos as $p): ?>
                <li>
                    <strong><?= htmlspecialchars($p['nombre']) ?></strong>
                    - <?= number_format($p['precio'], 2) ?> €
                    <br>
                    <em><?= htmlspecialchars($p['descripcion'] ?? '') ?></em>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No hay productos todavía.</p>
    <?php endif; ?>

</body>
</html>
