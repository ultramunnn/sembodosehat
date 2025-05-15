<?php
// add_penyakit.php

// Aktifkan error reporting untuk debugging (hapus jika sudah stabil)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$pageTitle = "Tambah Riwayat Penyakit";

$message = '';
// Contoh validasi dan proses POST sederhana
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $penyakit = trim($_POST['penyakit'] ?? '');
    $deskripsi = trim($_POST['deskripsi'] ?? '');

    if ($penyakit === '' || $deskripsi === '') {
        $message = '<div class="alert alert-danger">Semua field wajib diisi!</div>';
    } else {
        // TODO: simpan data ke database di sini
        $message = '<div class="alert alert-success">Data riwayat penyakit berhasil disimpan!</div>';
    }
}

$content = <<<HTML
$message
<form method="POST" action="">
    <div class="mb-3">
        <label for="penyakit" class="form-label fw-semibold">Nama Penyakit</label>
        <input type="text" id="penyakit" name="penyakit" class="form-control" placeholder="Masukkan nama penyakit" required autofocus>
    </div>
    
    <button type="submit" class="btn btn-green px-4 py-2">Simpan</button>
    <a href="dashboard.php" class="btn btn-outline-success ms-3">Kembali</a>
</form>
HTML;

// Sertakan template utama
include __DIR__ . '/../includes/app_admin.php';
?>