<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include 'koneksi.php';



//fungsi validasi input string kosong
function validate_required($value, $name, array &$error)
{
    if (trim($value) === '') {
        $error[$name] = 'Nama tidak boleh kosong';
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


?>