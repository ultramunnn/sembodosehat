<?php
// index.php di folder admin misalnya

$page = $_GET['page'] ?? 'dashboard';

switch ($page) {

    case 'tambah_artikel':
        $pageTitle = 'Tambah Artikel';
        ob_start();
        include __DIR__ . '/../includes/tambah_artikel.php';
        $content = ob_get_clean();
        break;

    case 'tambah_video':
        $pageTitle = 'Tambah Video';
        ob_start();
        include __DIR__ . '/../includes/tambah_video.php';
        $content = ob_get_clean();
        break;

    case 'tambah_penyakit':
        $pageTitle = 'Tambah Riwayat Penyakit';
        ob_start();
        include __DIR__ . '/../includes/tambah_penyakit.php';
        $content = ob_get_clean();
        break;

    case 'edit_konten':
        $pageTitle = 'Edit Konten';
        ob_start();
        include __DIR__ . '/../includes/edit_konten.php';
        $content = ob_get_clean();
        break;

    case 'logout':
        session_start();
        session_destroy();
        header('Location: ../login.php');
        exit; // berhenti eksekusi



    default:
        $pageTitle = 'Dashboard';
        ob_start();
        include __DIR__ . '/../includes/dashboard.php';
        $content = ob_get_clean();
        break;
}

// Load template utama dengan konten
include __DIR__ . '/../includes/app_admin.php';
