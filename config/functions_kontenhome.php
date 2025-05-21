<?php
include 'koneksi.php';


//fungsi menampilkan konten ke halaman home
function tampilkanKontenTerbaru($conn, $limit = 5)
{
    $query = "
        SELECT 
            k.id, k.judul, k.deskripsi, k.gambar, k.video_link, k.tipe_konten,
            rp.nama AS penyakit_nama
        FROM konten k
        JOIN konten_penyakit kp ON k.id = kp.konten_id
        JOIN riwayat_penyakit rp ON kp.penyakit_id = rp.id
        ORDER BY k.created_at DESC
        LIMIT $limit
    ";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        return false;
    }
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getYoutubeVideoId($url)
{
    if (!is_string($url) || empty($url)) {
        return null;
    }
    // Cek apakah input sudah ID video (11 karakter)
    if (preg_match('/^[a-zA-Z0-9_-]{11}$/', $url)) {
        return $url;
    }
    // Ambil ID video dari URL YouTube
    if (preg_match('/(?:youtu\.be\/|v=|\/embed\/|\/v\/)([a-zA-Z0-9_-]{11})/', $url, $matches)) {
        return $matches[1];
    }
    return null;
}







?>