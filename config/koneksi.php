<?php
// koneksi.php
$host = 'localhost';
$user = 'root';        // sesuaikan username DB kamu
$password = '';        // sesuaikan password DB kamu
$dbname = 'sembodo_sehat'; // nama database

// Buat koneksi
$conn = new mysqli($host, $user, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Set charset agar support utf8
$conn->set_charset("utf8");
