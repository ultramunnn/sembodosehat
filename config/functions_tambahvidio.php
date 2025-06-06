<?php
// functions_tambahvidio.php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'koneksi.php';

function validate_video_input(array &$errors)
{
    $required_fields = ['judul', 'deskripsi', 'link', 'penyakit_id'];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[$field] = ucfirst(str_replace('_', ' ', $field)) . ' tidak boleh kosong';
        }
    }

    // Validasi format link YouTube (opsional)
    if (
        !empty($_POST['link']) && !preg_match(
            '/^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/(watch\?v=|embed\/|v\/|.+\?v=)?([^&=%\?]{11})/',
            $_POST['link']
        )
    ) {
        $errors['link'] = 'Format link YouTube tidak valid';
    }
}

function cek_duplikasi_video($conn)
{
    $link = $_POST['link'];
    $sql = "SELECT id FROM konten WHERE video_link = '$link'";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result) > 0;
}

function tambah_video($conn)
{
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $link = $_POST['link'];
    $penyakit_id = intval($_POST['penyakit_id']);

    // Insert data video ke tabel konten
    $sql = "INSERT INTO konten (judul, deskripsi, video_link, tipe_konten) VALUES (
        '$judul',
        '$deskripsi',
        '$link',
        'video'
      
    )";

    if (!mysqli_query($conn, $sql)) {
        return false;
    }

    $konten_id = mysqli_insert_id($conn);

    // Insert data relasi ke tabel konten_penyakit
    $sql_rel = "INSERT INTO konten_penyakit (konten_id, penyakit_id) VALUES ($konten_id, $penyakit_id)";
    if (!mysqli_query($conn, $sql_rel)) {
        return false;
    }

    return true;
}

function proses_tambah_video($conn)
{
    $errors = [];
    $success = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        validate_video_input($errors);

        if (empty($errors) && cek_duplikasi_video($conn)) {
            $errors['duplikasi'] = 'Video dengan link yang sama sudah ada';
        }

        if (empty($errors)) {
            if (tambah_video($conn)) {
                header('Location: ../admin/index.php?page=tambah_video&success=1');
                exit();
            } else {
                $errors['database'] = 'Gagal menyimpan video: ' . mysqli_error($conn);
            }
        }
    } elseif (isset($_GET['success'])) {
        $success = 'Video berhasil ditambahkan';
    }

    return ['errors' => $errors, 'success' => $success];
}
