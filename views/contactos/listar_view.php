<?php include_once __DIR__ . '/../helpers/contactos_helper.php'; ?>
<div class="container mt-4">
<?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i> 
        <?php 
            echo match($_GET['success']) {
                'created' => 'Contacto creado con éxito.',
                'updated' => 'Contacto actualizado correctamente.',
                'deleted' => 'Contacto eliminado correctamente.',
                default   => 'Operación realizada con éxito.'
            };
        ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle me-2"></i> Error al procesar la solicitud.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

    <h1 class="mb-4">
        <?= htmlspecialchars($data['titulo']) ?>
        <a href="<?= BASE_URL ?>/contactos/crear" class="text-success" title="Agregar contacto">
            <i class="fas fa-plus-circle"></i>
        </a>
    </h1>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <form action="<?= BASE_URL ?>/contactos/search" method="get" class="flex-grow-1">
            <div class="input-group">
                <input type="text" class="form-control" name="q"
                       placeholder="Buscar contactos..."
                       value="<?= htmlspecialchars($data['filtros']['q'] ?? '') ?>">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search"></i> Buscar
                </button>
            </div>
        </form>
    </div>

    <?php if (empty($data['contactos'])): ?>
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle"></i> No hay contactos disponibles.
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($data['contactos'] as $contacto): ?>
                <?php include __DIR__ . '/partials/contacto_card.php'; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
