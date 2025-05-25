<?php 
$page = $_GET['page'] ?? 'dashboard';


ob_start();
include'../includes/cardartikel_konten.php';
$content = ob_get_clean();

// Load template utama dengan konten
include __DIR__ . '/../includes/app.php';
?>