<?php
// includes/app.php
// Template utama dengan sidebar dan layout
// $pageTitle = judul halaman, wajib di-set sebelum include app.php
// $content = konten HTML dinamis yang dimasukkan ke layout

if (!isset($pageTitle)) {
    $pageTitle = 'Dashboard Admin';
}
if (!isset($content)) {
    $content = '<p>Konten belum tersedia.</p>';
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= htmlspecialchars($pageTitle) ?> - SembodoSehat</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/app.css" />

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-green navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="/dashboard.php">SembodoSehat Admin</a>
        </div>
    </nav>

    <div class="d-flex">
        <!-- Sidebar -->
        <?php include __DIR__ . '/sidebar_admin.php'; ?>

        <!-- Konten utama -->
        <main class="content flex-grow-1">
            <h1 class="mb-4 text-success"><?= htmlspecialchars($pageTitle) ?></h1>
            <?= $content ?>
        </main>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>