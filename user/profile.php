<?php
session_start();
include '../config/koneksi.php';
include '../config/functions_profil.php';

$email = $_SESSION['email'];
$user = getUserProfile($conn, $email);

// Cek jika data penting kosong DAN BUKAN di mode edit
if (
    (!isset($_GET['edit']) || $_GET['edit'] != 1) && (
        empty($user['nama_lengkap']) ||
        empty($user['alamat']) ||
        empty($user['jenis_kelamin']) ||
        empty($user['usia'])
    )
) {
    header('Location: profile.php?edit=1');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Proses update profil
    prosesUpdateProfil($conn, $_POST, $_FILES);
    // Redirect ke tampilan profil (bukan edit)
    header('Location: profile.php');
    exit;
}

$edit = isset($_GET['edit']) ? true : false;

$penyakit = getNamaPenyakit($conn, $user['penyakit_id']);

ob_start();
include '../includes/page_profile.php';
$content = ob_get_clean();

include __DIR__ . '/../includes/app.php';
?>
<a href="profile.php?edit=1" ...>Edit</a>