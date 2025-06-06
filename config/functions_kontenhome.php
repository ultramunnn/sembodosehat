<?php
include 'koneksi.php';


//fungsi menampilkan konten ke halaman home
function tampilkanKontenTerbaru($conn, $limit = 5)
{
    $query = "SELECT k.id, k.judul, k.deskripsi, k.gambar, k.video_link, k.tipe_konten,
        rp.nama AS penyakit_nama FROM konten k 
        JOIN konten_penyakit kp ON k.id = kp.konten_id
        JOIN riwayat_penyakit rp ON kp.penyakit_id = rp.id 
        ORDER BY k.id DESC
        LIMIT $limit
    ";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        return false;
    }
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}


//fungsi untuk mengambil ID video dari URL agar bisa menampilkan thumnail yt
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



//fungsi total artikel
function getTotalArtikel($conn)
{
    $sql = "SELECT COUNT(*) AS total FROM konten WHERE tipe_konten = 'Artikel'";
    $result = $conn->query($sql);
    if ($result && $row = $result->fetch_assoc()) {
        return (int) $row['total'];
    }
    return 0;
}


//fungsi menampilkan artikel
function tampilkanArtikelTerbaru($conn, $limit = 6, $offset = 0)
{
    $limit = (int) $limit;
    $offset = (int) $offset;


    $sql = "SELECT k.id, k.judul, k.deskripsi, k.gambar, k.tipe_konten, rp.nama AS penyakit_nama
    FROM konten k JOIN konten_penyakit kp ON k.id = kp.konten_id JOIN riwayat_penyakit rp ON kp.penyakit_id = rp.id WHERE k.tipe_konten = 'Artikel' ORDER BY k.id DESC
    LIMIT $limit OFFSET $offset";

    $result = $conn->query($sql);

    $kontens = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $kontens[] = $row;
        }
    }
    return $kontens;
}

//fungsi total video
function getTotalVideos($conn)
{
    $sql = "SELECT COUNT(*) as total FROM konten WHERE tipe_konten = 'Video'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return (int) $row['total'];
}


function tampilkanVideoTerbaru($conn, $limit, $offset)
{
    $limit = (int) $limit;
    $offset = (int) $offset;

    $sql = "SELECT k.id, k.judul, k.deskripsi, k.video_link, k.tipe_konten, rp.nama AS penyakit_nama FROM konten k JOIN konten_penyakit kp ON k.id = kp.konten_id JOIN riwayat_penyakit rp ON kp.penyakit_id = rp.id WHERE k.tipe_konten = 'Video' ORDER BY k.id DESC LIMIT $limit OFFSET $offset";

    $result = $conn->query($sql);

    $kontens = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $kontens[] = $row;
        }
    }
    return $kontens;
}


//fungsi searching
function searching($conn, $keyword)
{
    $keyword = $conn->real_escape_string($keyword);
    $sql = "
        SELECT k.id, k.judul, k.deskripsi, k.gambar, k.video_link, k.tipe_konten, rp.nama AS penyakit_nama
        FROM konten k
        LEFT JOIN konten_penyakit kp ON k.id = kp.konten_id
        LEFT JOIN riwayat_penyakit rp ON kp.penyakit_id = rp.id
        WHERE (k.judul LIKE '%$keyword%' OR k.deskripsi LIKE '%$keyword%')
        ORDER BY k.id DESC
    ";

    $result = $conn->query($sql);
    $data = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;
}






?>