<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pedido realizado</title>
</head>
<body>

<h1>✅ Pedido realizado correctamente</h1>

<p>Tu número de pedido es: <strong><?= $id_pedido ?></strong></p>
<p>Total pagado: <strong><?= number_format($total, 2) ?> €</strong></p>

<a href="index.php?controller=producto&action=lista">Volver a productos</a>

</body>
</html>
