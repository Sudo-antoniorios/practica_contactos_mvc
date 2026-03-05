

<div class="container mt-5">
    <div class="jumbotron bg-white border shadow-sm">
        <div class="row align-items-center">
            <div class="col-md10">
                <h1 class="display-6 text-primary font-weight-bold">
                    <i class="fas fa-address-book"></i> Agenda Pro
                </h1>
                <p class="lead text-muted">Bienvenido al panel central de gestión.</p>
                <hr class="my-4">
                <p>Gestiona tu base de datos de contactos de forma profesional y segura.</p>
            </div>
            <div class="col-md-4 text-center d-none d-md-block">
                <i class="fas fa-chart-line fa-7x text-light"></i>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm bg-primary text-white h-100">
                <div class="card-body text-center d-flex flex-column justify-content-center">
                    <i class="fas fa-users fa-4x mb-3"></i>
                    <h2 class="display-4 mb-0 font-weight-bold"><?= $data['total'] ?></h2>
                    <p class="text-uppercase small font-weight-bold">Contactos guardados</p>
                    <div class="mt-3">
                        <a href="<?= BASE_URL ?>/contactos" class="btn btn-light btn-sm font-weight-bold">
                            <i class="fas fa-list"></i> Administrar listado
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0 text-dark">
                        <i class="fas fa-history text-warning mr-2"></i> Añadidos recientemente
                    </h5>
                    <a href="<?= BASE_URL ?>/contactos/crear" class="btn btn-success btn-sm font-weight-bold">
                        <i class="fas fa-plus mr-1"></i> Nuevo Contacto
                    </a>
                </div>
                <div class="card-body p-0">
                    <?php if (empty($data['ultimos'])): ?>
                        <div class="text-center py-5">
                            <i class="fas fa-user-slash fa-3x text-light mb-3"></i>
                            <p class="text-muted mb-0">No hay contactos registrados todavía.</p>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="border-top-0">Contacto</th>
                                        <th class="border-top-0">Teléfono</th>
                                        <th class="border-top-0 text-right px-4">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data['ultimos'] as $c): ?>
                                        <tr>
                                            <td class="align-middle">
                                                <div class="d-flex align-items-center">
                                                    <?= view_contacto_avatar($c['nombre']) ?>
                                                    
                                                    <div class="ml-3">
                                                        <div class="font-weight-bold text-dark">
                                                            <?= htmlspecialchars($c['nombre']) ?>
                                                        </div>
                                                        <small class="text-muted">Última actividad</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <span class="badge badge-light border text-muted px-2 py-2">
                                                    <i class="fas fa-phone-alt mr-1"></i> 
                                                    <?= htmlspecialchars($c['telefono']) ?>
                                                </span>
                                            </td>
                                            <td class="align-middle text-right px-4">
                                                <a href="<?= BASE_URL ?>/contactos/ver/<?= $c['id'] ?>" 
                                                   class="btn btn-sm btn-outline-info shadow-sm" 
                                                   title="Ver detalles">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>