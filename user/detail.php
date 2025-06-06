<?php
include '../config/koneksi.php';
include '../config/functions_kontenhome.php';

// Mulai output buffering
ob_start();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id < 1) {
    echo "<div class='max-w-2xl mx-auto mt-10 text-center text-red-600'>Konten tidak ditemukan.</div>";
} else {
    $sql = "SELECT * FROM konten WHERE id = $id";
    $result = $conn->query($sql);
    if ($result && $row = $result->fetch_assoc()) {
        ?>
        <div class="max-w-2xl mx-auto mt-10 bg-white rounded-xl shadow-lg p-8">
            <h1 class="text-3xl font-bold mb-4"><?= htmlspecialchars($row['judul']) ?></h1>
            <p class="text-gray-700 mb-6"><?= nl2br(htmlspecialchars($row['deskripsi'])) ?></p>
            <?php if ($row['tipe_konten'] == 'Video'): ?>
                <?php $videoId = getYoutubeVideoId($row['video_link']); ?>
                <?php if ($videoId): ?>
                    <div class="aspect-w-16 aspect-h-9 mb-4">
                        <iframe width="100%" height="400" src="https://www.youtube.com/embed/<?= $videoId ?>" frameborder="0" allowfullscreen></iframe>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <?php if (!empty($row['gambar'])): ?>
                    <img src="../assets/img/artikel/<?= htmlspecialchars($row['gambar']) ?>" alt="Gambar Artikel" class="w-full rounded-lg mb-4" />
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <?php
    } else {
        echo "<div class='max-w-2xl mx-auto mt-10 text-center text-red-600'>Konten tidak ditemukan.</div>";
    }
}

// Ambil isi buffer
$content = ob_get_clean();

// Sisipkan ke template utama
include __DIR__ . '/../includes/app.php';
?>