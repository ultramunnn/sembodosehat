<?php

include 'koneksi.php';

function editKonten($id)
{
    global $conn;

    // Get content ID from URL
    $content_id = isset($_GET['id']) ? $_GET['id'] : null;

    if ($content_id) {
        // Regular query to get content details
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


?>