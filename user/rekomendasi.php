<?php
$page = $_GET['page'] ?? 'rekomendasi';

ob_start();
include '../includes/cardrekomendasi.php';
$content = ob_get_clean();

// Load template utama dengan konten
include __DIR__ . '/../includes/app.php';
?>