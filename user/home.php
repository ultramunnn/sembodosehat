<?php
$pageTitle = "SembodoSehat";
include __DIR__ . '/../config/koneksi.php';
include __DIR__ . '/../config/function_tampilartikel.php';

// Tangkap parameter page dari URL
$page = $_GET['page'] ?? 'home';

// Inisialisasi variabel konten dan judul halaman
$content = '';
$showNavbar = true;
$showFooter = true;

switch ($page) {
    case 'tampilan_artikel':
        $artikel_id = $_GET['id'] ?? 0;
        $artikel = getArtikelById($conn, $artikel_id);

        if (!$artikel) {
            $pageTitle = "Artikel Tidak Ditemukan";
            $content = "<p>Maaf, artikel tidak ditemukan.</p>";
        } else {
            $pageTitle = htmlspecialchars($artikel['judul']);
            // Render artikel ke buffer
            ob_start();
            include __DIR__ . '/../includes/tampilan_artikel.php';
            $content = ob_get_clean();
        }
        break;

    case 'home':
    default:
        $pageTitle = "Beranda - SembodoSehat";

        ob_start();
        include __DIR__ . '/../includes/herosection_home.php';
        include __DIR__ . '/../includes/cardkontenterbaru_home.php';
        include __DIR__ . '/../includes/about_home.php';
        $content = ob_get_clean();
        break;
    case 'tampilan_video':
        $pageTitle = "Video - SembodoSehat";
        ob_start();
        include __DIR__ . '/../includes/tampilan_video.php';
        $content = ob_get_clean();
        break;
}

// Render layout utama
include __DIR__ . '/../includes/app.php';
