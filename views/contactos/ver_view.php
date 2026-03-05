
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-user-circle text-primary"></i> <?= htmlspecialchars($data['titulo']) ?></h1>
        <a href="<?= BASE_URL ?>/contactos" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Volver al listado
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4 border-primary">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-id-card"></i> Datos del Contacto</h5>
                    <a href="<?= BASE_URL ?>/contactos/editar/<?= $data['contacto']['id'] ?>" class="btn btn-light btn-sm font-weight-bold">
                        <i class="fas fa-edit text-warning"></i> Editar Datos
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4 font-weight-bold text-muted">Nombre completo:</div>
                        <div class="col-sm-8 mb-3 border-bottom pb-2">
                            <span class="h5 text-dark"><?= htmlspecialchars($data['contacto']['nombre']) ?></span>
                        </div>

                        <div class="col-sm-4 font-weight-bold text-muted">Teléfono:</div>
                        <div class="col-sm-8 mb-3 border-bottom pb-2">
                            <a href="tel:<?= htmlspecialchars($data['contacto']['telefono']) ?>" class="text-decoration-none">
                                <i class="fas fa-phone-alt mr-2"></i><?= htmlspecialchars($data['contacto']['telefono']) ?>
                            </a>
                        </div>

                        <div class="col-sm-4 font-weight-bold text-muted">Correo electrónico:</div>
                        <div class="col-sm-8 mb-3">
                            <a href="mailto:<?= htmlspecialchars($data['contacto']['email']) ?>" class="text-decoration-none">
                                <i class="fas fa-envelope mr-2"></i><?= htmlspecialchars($data['contacto']['email']) ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-light">
                <div class="card-header bg-light">
                    <h5 class="mb-0 text-secondary"><i class="fas fa-history"></i> Gestión del Registro</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <small class="text-uppercase font-weight-bold text-muted">Fecha de creación</small>
                        <p class="mb-0"><i class="far fa-calendar-check text-success mr-2"></i><?= htmlspecialchars($data['contacto']['created_at'] ?? 'No disponible') ?></p>
                    </div>
                    
                    <div class="mb-3">
                        <small class="text-uppercase font-weight-bold text-muted">Tiempo en agenda</small>
                        <div>
                            <span class="badge badge-info px-3 py-2">
                                <i class="fas fa-clock mr-1"></i> 
                                <?= diasTranscurridos($data['contacto']['created_at_raw'] ?? date('Y-m-d')) ?>
                            </span>
                        </div>
                    </div>

                    <hr>
                    
                    <div class="mt-2">
                        <small class="text-uppercase font-weight-bold text-muted">Última actualización</small>
                        <p class="text-muted small mb-0">
                            <i class="fas fa-sync-alt mr-1"></i> <?= htmlspecialchars($data['contacto']['updated_at'] ?? 'Sin cambios registrados') ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>