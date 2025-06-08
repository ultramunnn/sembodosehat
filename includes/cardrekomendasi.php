<?php
session_start();
include __DIR__ . '/../config/koneksi.php';
include_once __DIR__ . '/../config/functions_profil.php';

// Tambahkan fungsi ini sebelum kode lain
function getYoutubeVideoId($url) {
    if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $url, $matches)) {
        return $matches[1];
    }
    return null;
}

// Cek apakah user sudah login
if (!isset($_SESSION['email'])) {
    // Redirect ke halaman login atau tampilkan pesan
    echo '<div class="text-center text-red-500 mt-10">Anda harus login untuk melihat rekomendasi.</div>';
    return;
}

$user = getUserProfile($conn, $_SESSION['email']);
$penyakit_id = $user['penyakit_id'] ?? '';

$ids = array_filter(array_map('trim', explode(',', $penyakit_id)), 'is_numeric');
$artikels = [];
$videos = [];

if (count($ids) > 0) {
    $in = implode(',', $ids);

    // Artikel rekomendasi
    $queryArtikel = "
        SELECT DISTINCT k.*, rp.nama AS penyakit_nama
        FROM konten k
        JOIN konten_penyakit kp ON k.id = kp.konten_id
        JOIN riwayat_penyakit rp ON kp.penyakit_id = rp.id
        WHERE kp.penyakit_id IN ($in) AND k.tipe_konten = 'Artikel'
    ";
    $resultArtikel = mysqli_query($conn, $queryArtikel);
    while ($row = mysqli_fetch_assoc($resultArtikel)) {
        $artikels[] = $row;
    }

    // Video rekomendasi
    $queryVideo = "
        SELECT DISTINCT k.*, rp.nama AS penyakit_nama
        FROM konten k
        JOIN konten_penyakit kp ON k.id = kp.konten_id
        JOIN riwayat_penyakit rp ON kp.penyakit_id = rp.id
        WHERE kp.penyakit_id IN ($in) AND k.tipe_konten = 'Video'
    ";
    $resultVideo = mysqli_query($conn, $queryVideo);
    while ($row = mysqli_fetch_assoc($resultVideo)) {
        $videos[] = $row;
    }
}
?>

<div class="max-w-[1200px] mx-auto px-4 mt-8">
    <div class="flex items-center space-x-2 mb-4">
        <span class="material-symbols-outlined p-6d">menu_book</span>
        <h2 class="text-black text-3xl font-semibold font-poppins">Rekomendasi Artikel</h2>
    </div>
    <div class="flex flex-wrap gap-6 justify-center">
        <?php if (empty($artikels)): ?>
            <p class="text-gray-500 ml-6 col-span-3">Tidak ada rekomendasi artikel untuk Anda.</p>
        <?php else: ?>
            <?php foreach ($artikels as $artikel): ?>
                <article class="max-w-[350px] h-full md:w-[30%] rounded-xl overflow-hidden shadow-lg hover:shadow-2xl mb-6 transition-shadow duration-300">
                    <img src="<?= $artikel['gambar'] ? '../assets/img/artikel/' . $artikel['gambar'] : 'default.jpg' ?>"
                        alt="<?= $artikel['judul'] ?? '' ?>" class="w-full h-[250px] rounded-t-lg object-cover" />
                    <div class="bg-green-950/95 rounded-b-lg p-4">
                        <h3 class="text-white text-xl font-semibold font-poppins mb-6">
                            <?= $artikel['judul'] ?? '' ?>
                        </h3>
                        <p class="text-white text-l font-light font-poppins mb-3 leading-relaxed">
                            <?= $artikel['deskripsi'] ?? '' ?>
                        </p>
                        <div class="border border-white mb-4"></div>
                        <div class="flex items-center gap-2">
                            <span class="bg-green-500/50 rounded px-3 py-1 text-white text-sm font-light font-poppins">
                                <?= $artikel['tipe_konten'] ?? '' ?>
                            </span>
                            <span class="bg-green-500/50 rounded px-3 py-1 text-white text-sm font-light font-poppins">
                                <?= $artikel['penyakit_nama'] ?? '' ?>
                            </span>
                            <a href="detail.php?id=<?= urlencode($artikel['id']) ?>"
                                class="text-white text-l ml-auto font-light font-poppins whitespace-nowrap">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <div class="flex items-center space-x-2 mb-4 mt-12">
        <span class="material-symbols-outlined p-6d">video_library</span>
        <h2 class="text-black text-3xl font-semibold font-poppins">Rekomendasi Video</h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 justify-center">
        <?php if (empty($videos)): ?>
            <p class="text-gray-500 ml-6 col-span-3">Tidak ada rekomendasi video untuk Anda.</p>
        <?php else: ?>
            <?php foreach ($videos as $video): ?>
                <?php $video_id = getYoutubeVideoId($video['video_link'] ?? ''); ?>
                <article class="rounded-xl overflow-hidden shadow-lg hover:shadow-2xl mb-5 transition-shadow duration-300">
                    <?php if ($video_id): ?>
                        <div class="relative">
                            <img src="https://img.youtube.com/vi/<?= $video_id ?>/hqdefault.jpg" alt="<?= $video['judul'] ?? '' ?>"
                                class="w-full h-[200px] md:h-[250px] lg:h-[300px] rounded-t-lg object-cover" />
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="material-symbols-outlined text-white text-6xl bg-black bg-opacity-50 rounded-full p-4">play_circle</span>
                            </div>
                        </div>
                    <?php else: ?>
                        <img src="default.jpg" alt="Default Thumbnail" class="w-full h-[400px] rounded-t-lg object-cover" />
                    <?php endif; ?>
                    <div class="bg-green-950/95 rounded-b-lg p-6">
                        <h3 class="text-white text-xl font-semibold font-poppins mb-4">
                            <?= $video['judul'] ?? '' ?>
                        </h3>
                        <p class="text-white text-l font-light font-poppins mb-6 leading-relaxed">
                            <?= $video['deskripsi'] ?? '' ?>
                        </p>
                        <div class="border border-white mb-4"></div>
                        <div class="flex items-center gap-2">
                            <span class="bg-green-500/50 rounded px-3 py-1 text-white text-sm font-light font-poppins">
                                <?= $video['tipe_konten'] ?? '' ?>
                            </span>
                            <span class="bg-green-500/50 rounded px-3 py-1 text-white text-sm font-light font-poppins">
                                <?= $video['penyakit_nama'] ?? '' ?>
                            </span>
                            <a href="detail.php?id=<?= urlencode($video['id']) ?>"
                                class="text-white text-l ml-auto font-light font-poppins whitespace-nowrap">
                                Tonton Video
                            </a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>