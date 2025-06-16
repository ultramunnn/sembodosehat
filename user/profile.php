<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header('Location: ../login.php');
    exit;
}

include '../config/koneksi.php';
include '../config/functions_profil.php';

$email = $_SESSION['email'];
$user = getUserProfile($conn, $email);

// Check if user profile exists
if (!$user) {
    header('Location: ../login.php');
    exit;
}

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
    // Simpan foto lama ke dalam POST data jika tidak ada upload foto baru
    if (!isset($_FILES['fotoProfil']) || $_FILES['fotoProfil']['error'] === UPLOAD_ERR_NO_FILE) {
        $_POST['foto_lama'] = $user['foto_user']; // Simpan path foto lama
    }
    
    // Proses update profil
    prosesUpdateProfil($conn, $_POST, $_FILES);
    // Redirect ke tampilan profil (bukan edit)
    header('Location: profile.php');
    exit;
}

$edit = isset($_GET['edit']) ? true : false;

// Only get penyakit name if penyakit_id exists
$penyakit = null;
if (!empty($user['penyakit_id'])) {
    $penyakit = getNamaPenyakit($conn, $user['penyakit_id']);
}

ob_start();
include '../includes/page_profile.php';
$content = ob_get_clean();

include __DIR__ . '/../includes/app.php';
?>
<a href="profile.php?edit=1" ...>Edit</a>