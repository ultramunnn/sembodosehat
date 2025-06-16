<?php
require_once "koneksi.php";

// Function to get all videos
function getAllVideos() {
    global $conn;
    $query = "SELECT * FROM konten WHERE video_link IS NOT NULL AND video_link != ''";
    $result = mysqli_query($conn, $query);
    return $result;
}

// Function to get a single video by ID
function getVideoById($id) {
    global $conn;
    $query = "SELECT * FROM konten WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
}

// Function to extract YouTube video ID from URL
function getYoutubeVideoId($url) {
    $video_id = '';
    if (preg_match('/[?&]v=([^&]+)/', $url, $matches)) {
        $video_id = $matches[1];
    } elseif (preg_match('/youtu\.be\/([^?&]+)/', $url, $matches)) {
        $video_id = $matches[1];
    }
    return $video_id;
}
?>
