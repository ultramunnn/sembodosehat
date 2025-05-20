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

//fungsi cek duplikasi nama penyakit
function cek_duplikasi_penyakit($conn, $nama)
{
    $stmt = $conn->prepare("SELECT * FROM riwayat_penyakit WHERE nama= ?");
    $stmt->bind_param("s", $nama);
    $stmt->execute();
    $stmt->store_result();
    $found = $stmt->num_rows > 0;
    $stmt->close();

    return $found;
}

//fungsi menambahkan penyakit baru
function tambah_penyakit($conn, $nama)
{
    $stmt = $conn->prepare("INSERT INTO riwayat_penyakit (nama) VALUES (?)");
    $stmt->bind_param("s", $nama);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}


?>