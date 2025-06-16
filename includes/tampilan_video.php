<?php
    include '../config/koneksi.php';
include '../config/functions_kontenhome.php';



$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id < 1) {
    echo "<div class='max-w-2xl mx-auto mt-10 text-center text-red-600'>Video tidak ditemukan.</div>";
} else {
    $sql = "SELECT * FROM konten WHERE id = $id AND tipe_konten = 'Video'";
    $result = $conn->query($sql);
    if ($result && $row = $result->fetch_assoc()) {
        ?>
        <div class="max-w-2xl mx-auto mt-10 bg-white rounded-xl shadow-lg p-8">
            <h1 class="text-3xl font-bold mb-4"><?= htmlspecialchars($row['judul']) ?></h1>
            <p class="text-gray-700 mb-6"><?= nl2br(htmlspecialchars($row['deskripsi'])) ?></p>
            <?php $videoId = getYoutubeVideoId($row['video_link']); ?>
            <?php if ($videoId): ?>
                <div class="aspect-w-16 aspect-h-9 mb-4">
                    <iframe width="100%" height="400" src="https://www.youtube.com/embed/<?= $videoId ?>" frameborder="0" allowfullscreen></iframe>
                </div>
            <?php else: ?>
                <div class="text-center text-red-600">Link video tidak valid.</div>
            <?php endif; ?>
        </div>
        <?php
    } else {
        echo "<div class='max-w-2xl mx-auto mt-10 text-center text-red-600'>Video tidak ditemukan.</div>";
    }
}



?>