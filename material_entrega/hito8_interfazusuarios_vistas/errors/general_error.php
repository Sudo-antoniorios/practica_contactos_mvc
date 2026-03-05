<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($data['titulo']) ?> - Agenda Pro</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/errors.css">
</head>
<body>
    <div class="error-wrapper">
    <div class="error-card">
    <h1 class="error-code"><?= $data['codigo'] ?? ':(' ?></h1>
    <h2 class="error-title"><?= htmlspecialchars($data['titulo']) ?></h2>
    <p class="error-text">
        <?= htmlspecialchars($data['mensaje']) ?>
    </p>

    <?php if (isset($data['codigo']) && $data['codigo'] >= 500): ?>
        <p class="admin-notice">
            <i class="fas fa-info-circle"></i> Nuestro equipo técnico ha sido notificado para solucionar este incidente.
        </p>
    <?php else: ?>
        <p class="user-notice">Por favor, verifica la dirección o intenta buscar de nuevo.</p>
    <?php endif; ?>

    <a href="<?= BASE_URL ?>" class="btn-error">Volver al Inicio</a>
</div>
    </div>
</body>
</html>