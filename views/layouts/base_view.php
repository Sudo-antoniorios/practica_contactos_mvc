<head>
    <title><?= $data['titulo'] ?? 'Agenda de Contactos' ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include __DIR__ . '/../includes/nav_view.php'; ?>
    
    <main class="flex-fill">
        <?= $content ?>
    </main>
    
    <?php include __DIR__ . '/../includes/footer_view.php'; ?>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>