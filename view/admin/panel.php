<?php include __DIR__ . '/../templates/header.php'; ?>

<section class="admin-page">
    <section class="mb-5">
        <h1 class="h3 fw-bold mb-3">Panel de administración</h1>
        <p class="text-muted mb-4">Gestiona productos, pedidos, logs y moneda desde aquí.</p>

        <div class="mb-3 d-flex flex-wrap gap-2">
            <!-- Acciones de productos -->
            <button id="btnNuevo" class="btn btn-success btn-sm">Nuevo producto</button>
            <button id="btnEditar" class="btn btn-outline-primary btn-sm">Editar producto</button>
            <button id="btnEliminar" class="btn btn-outline-danger btn-sm">Eliminar producto</button>

            <!-- Otras secciones -->
            <button id="btnVerPedidos" class="btn btn-outline-success btn-sm">Pedidos</button>
            <button id="btnMoneda" class="btn btn-outline-warning btn-sm">Moneda</button>
            <button id="btnLogs" class="btn btn-outline-secondary btn-sm">Logs</button>
        </div>

        <div id="contenido"></div>
    </section>
</section>

<script src="/Healthy4Quality/admin/js/admin.js"></script>

<?php include __DIR__ . '/../templates/footer.php'; ?>

