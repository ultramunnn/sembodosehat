<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include 'koneksi.php';



//fungsi validasi input string kosong
function validate_required($value, $name, array &$error)
{
    if (trim($value) === '') {
        $error[$name] = $name . ' tidak boleh kosong';
    }

}

// Fungsi cek duplikasi nama penyakit 
function cek_duplikasi_penyakit($conn, $nama)
{
    $nama = $_POST['nama'];
    $sql = "SELECT * FROM riwayat_penyakit WHERE nama = '$nama'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {

        return false;
    }

    return mysqli_num_rows($result) > 0;
}

// Fungsi menambahkan penyakit baru 
function tambah_penyakit($conn, $nama)
{
    $nama = $_POST['nama'];
    $sql = "INSERT INTO riwayat_penyakit (nama) VALUES ('$nama')";
    $result = mysqli_query($conn, $sql);

    return $result; // true jika sukses, false jika gagal
}

//fungsi proses tambah_penyakit

function proses_tambah_penyakit($conn)
{
    $errors = [];
    $success = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nama'])) {
        $nama = $_POST['nama'];

        // Validasi input
        validate_required($nama, 'nama', $errors);

        // Cek duplikasi
        if (empty($errors) && cek_duplikasi_penyakit($conn, $nama)) {
            $errors['duplikasi'] = 'Penyakit sudah ada';
        }

        // Input data jika valid
        if (empty($errors)) {
            if (tambah_penyakit($conn, $nama)) {
                // Redirect setelah sukses
                header('Location: ../admin/index.php?page=tambah_penyakit&success=1');
                exit();
            } else {
                $errors['database'] = 'Gagal menambahkan riwayat penyakit';
            }
        }
    } elseif (isset($_GET['success'])) {
        $success = 'Penyakit berhasil ditambahkan';
    }

    return ['errors' => $errors, 'success' => $success];
}


//fungsi menampilkan semua data konten
function tampilkan_semua_konten($conn)
{
    $sql = "SELECT * FROM konten";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        return false;
    }

    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}


?>