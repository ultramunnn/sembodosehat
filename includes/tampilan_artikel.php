<?php
// Pastikan $artikel sudah tersedia dari pemanggil
if (!$artikel) {
    echo "<p>Artikel tidak ditemukan.</p>";
    return;
}

$gambar_path = $artikel['gambar'] ? '../assets/img/artikel/' . $artikel['gambar'] : 'default.jpg';
?>

<div class="flex items-center justify-center min-h-screen p-10">
    <div class="max-w-4xl w-full">
        <!-- Menampilkan gambar dengan style responsif -->
        <div class="mb-4 text-center">
            <img src="<?= htmlspecialchars($gambar_path) ?>" alt="<?= htmlspecialchars($artikel['judul']) ?>" 
                class="rounded-lg mx-auto" style="width: 500px; height: 300px; object-fit:cover "/>
        </div>

        <!-- Menampilkan judul artikel -->
        <h1 class="text-3xl font-bold mb-4 text-center"><?= htmlspecialchars($artikel['judul']) ?></h1>

        <!-- Menampilkan isi artikel dengan styling lebih rapi -->
        <div class="text-lg leading-relaxed whitespace-pre-wrap">
            <?= nl2br(htmlspecialchars($artikel['isi_artikel'])) ?>
        </div>
    </div>
</div>
