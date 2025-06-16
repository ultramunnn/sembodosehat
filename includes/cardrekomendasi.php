<?php
session_start();
include __DIR__ . '/../config/koneksi.php';
include_once __DIR__ . '/../config/functions_profil.php';
include_once __DIR__ . '/../config/functions_kontenhome.php';


// Cek apakah user sudah login
if (!isset($_SESSION['email'])) {
    // Redirect ke halaman login atau tampilkan pesan
    echo '<div class="text-center text-red-500 mt-10">Anda harus login untuk melihat rekomendasi.</div>';
    return;
}

// Pagination settings
$perPage = 6;
$page = isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0 ? (int) $_GET['page'] : 1;
$videoPage = isset($_GET['videoPage']) && is_numeric($_GET['videoPage']) && $_GET['videoPage'] > 0 ? (int) $_GET['videoPage'] : 1;

$offset = ($page - 1) * $perPage;
$videoOffset = ($videoPage - 1) * $perPage;

$user = getUserProfile($conn, $_SESSION['email']);
$penyakit_id = $user['penyakit_id'] ?? '';

$ids = array_filter(array_map('trim', explode(',', $penyakit_id)), 'is_numeric');
$artikels = [];
$videos = [];

if (count($ids) > 0) {
    $in = implode(',', $ids);

    // Artikel rekomendasi with pagination
    $queryArtikel = "
        SELECT DISTINCT k.*, rp.nama AS penyakit_nama
        FROM konten k
        JOIN konten_penyakit kp ON k.id = kp.konten_id
        JOIN riwayat_penyakit rp ON kp.penyakit_id = rp.id
        WHERE kp.penyakit_id IN ($in) AND k.tipe_konten = 'Artikel'
        LIMIT $perPage OFFSET $offset
    ";
    $resultArtikel = mysqli_query($conn, $queryArtikel);
    while ($row = mysqli_fetch_assoc($resultArtikel)) {
        $artikels[] = $row;
    }

    // Count total articles for pagination
    $countArtikelQuery = "
        SELECT COUNT(DISTINCT k.id) as total
        FROM konten k
        JOIN konten_penyakit kp ON k.id = kp.konten_id
        WHERE kp.penyakit_id IN ($in) AND k.tipe_konten = 'Artikel'
    ";
    $countArtikelResult = mysqli_query($conn, $countArtikelQuery);
    $totalArtikels = mysqli_fetch_assoc($countArtikelResult)['total'];
    $totalPages = ceil($totalArtikels / $perPage);

    // Video rekomendasi with pagination
    $queryVideo = "
        SELECT DISTINCT k.*, rp.nama AS penyakit_nama
        FROM konten k
        JOIN konten_penyakit kp ON k.id = kp.konten_id
        JOIN riwayat_penyakit rp ON kp.penyakit_id = rp.id
        WHERE kp.penyakit_id IN ($in) AND k.tipe_konten = 'Video'
        LIMIT $perPage OFFSET $videoOffset
    ";
    $resultVideo = mysqli_query($conn, $queryVideo);
    while ($row = mysqli_fetch_assoc($resultVideo)) {
        $videos[] = $row;
    }

    // Count total videos for pagination
    $countVideoQuery = "
        SELECT COUNT(DISTINCT k.id) as total
        FROM konten k
        JOIN konten_penyakit kp ON k.id = kp.konten_id
        WHERE kp.penyakit_id IN ($in) AND k.tipe_konten = 'Video'
    ";
    $countVideoResult = mysqli_query($conn, $countVideoQuery);
    $totalVideos = mysqli_fetch_assoc($countVideoResult)['total'];
    $totalVideoPages = ceil($totalVideos / $perPage);
}
?>

<style>
      /* Efek hover timbul pada card */
    .card:hover {
        transform: scale(1.05); /* Memberikan efek membesar */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); /* Efek bayangan */
        transition: transform 0.3s ease, box-shadow 0.3s ease; /* Memperhalus transisi */
    }
</style>

<div class="max-w-[1200px] mx-auto px-4 mt-20">
    <!-- Rekomendasi Artikel -->
    <div class="flex items-center space-x-2 mb-4">
        <span class="material-symbols-outlined p-6d">menu_book</span>
        <h2 class="text-black text-3xl font-semibold font-poppins">Rekomendasi Artikel</h2>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if (empty($artikels)): ?>
            <p class="text-gray-500 ml-6 col-span-3">Tidak ada rekomendasi artikel untuk Anda.</p>
        <?php else: ?>
            <?php foreach ($artikels as $artikel): ?>
                <article class="flex flex-col h-full rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-300 card">
                    <img src="<?= $artikel['gambar'] ? '../assets/img/artikel/' . $artikel['gambar'] : 'default.jpg' ?>"
                         alt="<?= $artikel['judul'] ?? '' ?>" 
                         class="w-full h-64 object-cover rounded-t-lg" />
                    <div class="flex flex-col flex-grow bg-green-950/95 rounded-b-lg p-4">
                        <h3 class="text-white text-xl font-semibold font-poppins mb-3 line-clamp-2">
                            <?= $artikel['judul'] ?? '' ?>
                        </h3>
                        <div class="flex-grow">
                            <p class="text-white text-base font-light font-poppins leading-relaxed line-clamp-3">
                                <?= $artikel['deskripsi'] ?? '' ?>
                            </p>
                        </div>
                        <div class="border border-white my-3"></div>
                        <div class="flex justify-between items-center">
                            <div class="flex flex-wrap gap-2">
                                <span class="bg-green-500/50 rounded px-3 py-1 text-white text-sm font-light font-poppins">
                                    <?= $artikel['tipe_konten'] ?? '' ?>
                                </span>
                                <span class="bg-green-500/50 rounded px-3 py-1 text-white text-sm font-light font-poppins">
                                    <?= $artikel['penyakit_nama'] ?? '' ?>
                                </span>
                            </div>
                            <a href="home.php?page=tampilan_artikel&id=<?= $artikel['id'] ?>"
                               class="text-white text-base font-light font-poppins whitespace-nowrap">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Pagination for Articles -->
    <?php if (isset($totalPages) && $totalPages > 1): ?>
        <nav class="mt-5 flex justify-center space-x-3 p-8">
            <?php if ($page > 1): ?>
                <a href="?page=<?= $page - 1 ?>&videoPage=<?= $videoPage ?>"
                    class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition">Prev</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i ?>&videoPage=<?= $videoPage ?>"
                    class="px-4 py-2 rounded hover:bg-green-600 transition <?= $i === $page ? 'bg-green-700 text-white' : 'bg-green-500 text-white' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <a href="?page=<?= $page + 1 ?>&videoPage=<?= $videoPage ?>"
                    class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition">Next</a>
            <?php endif; ?>
        </nav>
    <?php endif; ?>

    <!-- Rekomendasi Video -->
    <div class="flex items-center space-x-2 mb-4 mt-12">
        <span class="material-symbols-outlined p-6d">video_library</span>
        <h2 class="text-black text-3xl font-semibold font-poppins">Rekomendasi Video</h2>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <?php if (empty($videos)): ?>
            <p class="text-gray-500 ml-6 col-span-3">Tidak ada rekomendasi video untuk Anda.</p>
        <?php else: ?>
            <?php foreach ($videos as $video): ?>
                <?php $video_id = getYoutubeVideoId($video['video_link'] ?? ''); ?>
                <article class="flex flex-col h-full rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-300 card">
                    <div class="h-64 w-full">
                        <?php if ($video_id): ?>
                            <img src="https://img.youtube.com/vi/<?= $video_id ?>/hqdefault.jpg" 
                                 alt="<?= $video['judul'] ?? '' ?>"
                                 class="w-full h-full object-cover rounded-t-lg" />
                        <?php else: ?>
                            <img src="default.jpg" alt="Default Thumbnail" class="w-full h-full object-cover rounded-t-lg" />
                        <?php endif; ?>
                    </div>
                    <div class="flex flex-col flex-grow bg-green-950/95 rounded-b-lg p-6">
                        <h3 class="text-white text-xl font-semibold font-poppins mb-3 line-clamp-2">
                            <?= $video['judul'] ?? '' ?>
                        </h3>
                        <div class="flex-grow">
                            <p class="text-white text-base font-light font-poppins leading-relaxed line-clamp-3">
                                <?= $video['deskripsi'] ?? '' ?>
                            </p>
                        </div>
                        <div class="border border-white my-3"></div>
                        <div class="flex justify-between items-center">
                            <div class="flex flex-wrap gap-2">
                                <span class="bg-green-500/50 rounded px-3 py-1 text-white text-sm font-light font-poppins">
                                    <?= $video['tipe_konten'] ?? '' ?>
                                </span>
                                <span class="bg-green-500/50 rounded px-3 py-1 text-white text-sm font-light font-poppins">
                                    <?= $video['penyakit_nama'] ?? '' ?>
                                </span>
                            </div>
                            <a href="home.php?page=tampilan_video&id=<?= $video['id'] ?>"
                               class="text-white text-base font-light font-poppins whitespace-nowrap">
                                Tonton Video
                            </a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Pagination for Videos -->
    <?php if (isset($totalVideoPages) && $totalVideoPages > 1): ?>
        <nav class="mt-5 flex justify-center space-x-3 p-8">
            <?php if ($videoPage > 1): ?>
                <a href="?videoPage=<?= $videoPage - 1 ?>&page=<?= $page ?>"
                    class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition">Prev</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalVideoPages; $i++): ?>
                <a href="?videoPage=<?= $i ?>&page=<?= $page ?>"
                    class="px-4 py-2 rounded hover:bg-green-600 transition <?= $i === $videoPage ? 'bg-green-700 text-white' : 'bg-green-500 text-white' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>

            <?php if ($videoPage < $totalVideoPages): ?>
                <a href="?videoPage=<?= $videoPage + 1 ?>&page=<?= $page ?>"
                    class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition">Next</a>
            <?php endif; ?>
        </nav>
    <?php endif; ?>
</div>