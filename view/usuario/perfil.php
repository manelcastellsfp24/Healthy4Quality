<?php include __DIR__ . '/../templates/header.php'; ?>

<section class="perfil-page">
    <section class="mb-5">
        <h1 class="h3 fw-bold mb-3">Mi perfil</h1>
        <p class="text-muted mb-4">Actualiza tus datos y revisa tu historial de pedidos.</p>

        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h2 class="h5 fw-bold mb-3">Datos personales</h2>

                        <form action="index.php?controller=usuario&action=actualizarPerfil" method="post">
                            <div class="mb-3">
                                <label class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombre"
                                    value="<?= htmlspecialchars($usuarioDatos['nombre'] ?? '') ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email"
                                    value="<?= htmlspecialchars($usuarioDatos['email'] ?? '') ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Teléfono</label>
                                <input type="text" class="form-control" name="telefono"
                                    value="<?= htmlspecialchars($usuarioDatos['telefono'] ?? '') ?>">
                            </div>

                            <button type="submit" class="btn btn-success">Guardar cambios</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h2 class="h5 fw-bold mb-3">Mis pedidos</h2>

                        <?php if (!empty($pedidosUsuario)): ?>
                            <div class="table-responsive">
                                <table class="table table-sm align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Fecha</th>
                                            <th>Total</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($pedidosUsuario as $ped): ?>
                                        <tr>
                                            <td><?= $ped['id_pedido'] ?></td>
                                            <td><?= $ped['fecha'] ?></td>
                                            <td><?= number_format($ped['total'], 2) ?> €</td>
                                            <td><?= htmlspecialchars($ped['estado']) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <p class="text-muted mb-0">Todavía no has realizado ningún pedido.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>


<?php include __DIR__ . '/../templates/footer.php'; ?>
