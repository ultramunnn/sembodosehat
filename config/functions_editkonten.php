<?php

include 'koneksi.php';

// Debug
var_dump($_POST, $_FILES);

function editKonten($id)
{
    global $conn;
    $content_id = isset($_GET['id']) ? $_GET['id'] : null;
    if ($content_id) {
        $sql = "SELECT * FROM konten WHERE id = $content_id";
        $result = mysqli_query($conn, $sql);
        $content = mysqli_fetch_assoc($result);
        if (!$content) {
            echo "Konten tidak ditemukan.";
            exit;
        }
    } else {
        echo "ID konten tidak valid.";
        exit;
    }
    return $content;
}


function updateKonten($data, $files)
{
    global $conn;

    $id = intval($data['id']);
    $judul = $data['judul'];
    $deskripsi = $data['deskripsi'];
    $tipe_konten = $data['tipe_konten'];

    if ($tipe_konten == 'Artikel') {
        $isi_artikel = $data['isi_artikel'];

        $gambar = null;
        if (!empty($files['gambar']['name'])) {
            $target_dir = dirname(__DIR__) . "/assets/img/artikel/";

            $file_ext = $files['gambar']['name'];
            $gambar = time() . '.' . $file_ext;
            $target_file = $target_dir . $gambar;

            if (!move_uploaded_file($files['gambar']['tmp_name'], $target_file)) {
                // Jika upload gagal, abaikan update gambar
                $gambar = null;
            }
        }

        $sql = "UPDATE konten SET judul = '$judul', isi_artikel = '$isi_artikel', deskripsi = '$deskripsi'";

        if ($gambar !== null) {
            $sql .= ", gambar = '$gambar'";
        }

        $sql .= " WHERE id = $id";
    } else {
        $video_link = $data['video_link'];

        $sql = "UPDATE konten SET judul = '$judul', video_link = '$video_link', deskripsi = '$deskripsi' WHERE id = $id";
    }

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        return false;
    }

    if (mysqli_affected_rows($conn) < 1) {
        return false;
    }

    return true;
}



?>