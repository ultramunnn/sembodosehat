<?php
// functions_tambahvidio.php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'koneksi.php';

// Fungsi validasi input video
function validate_video_input(array &$errors) {
    // Validasi field required
    $required_fields = ['judul', 'deskripsi', 'link', 'id'];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[$field] = ucfirst($field) . ' tidak boleh kosong';
        }
    }

    // Validasi format YouTube
    if (!empty($_POST['link']) && !preg_match(
        '/^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/(watch\?v=|embed\/|v\/|.+\?v=)?([^&=%\?]{11})/',
        $_POST['link']
    )) {
        $errors['link'] = 'Format link YouTube tidak valid';
    }
}

function cek_duplikasi_video($conn) {
    $link = mysqli_real_escape_string($conn, $_POST['link']);
    $sql = "SELECT id FROM konten WHERE video_link = '$link'";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result) > 0;
}

function tambah_video($conn) {
    // Escape input
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $link = mysqli_real_escape_string($conn, $_POST['link']);
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    // Query insert
    $sql = "INSERT INTO konten (
        judul,
        deskripsi,
        video_link,
        id,
        tipe_konten
    ) VALUES (
        '$judul',
        '$deskripsi',
        '$link',
        '$id',
        'video'
    )";

    return mysqli_query($conn, $sql);
}

// Fungsi proses form video
function proses_tambah_video($conn) {
    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Validasi input
        validate_video_input($errors);

        // Cek duplikasi
        if (empty($errors) && cek_duplikasi_video($conn)) {
            $errors['duplikasi'] = 'Video dengan link yang sama sudah ada';
        }

        // Simpan ke database
        if (empty($errors)) {
            if (tambah_video($conn)) {
                header('Location: ?status=sukses');
                exit;
            } else {
                $errors['database'] = 'Gagal menyimpan video: ' . mysqli_error($conn);
            }
        }
    }
    
    return $errors;
}