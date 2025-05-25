<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include __DIR__ . '/../config/koneksi.php';
include __DIR__ . '/../config/functions_kontenhome.php';

// Tangkap keyword pencarian jika ada
$keyword = $_GET['keyword'] ?? '';


// Pagination default
$perPage = 6;

// Ambil page artikel & video, default 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0 ? (int) $_GET['page'] : 1;
$videoPage = isset($_GET['videoPage']) && is_numeric($_GET['videoPage']) && $_GET['videoPage'] > 0 ? (int) $_GET['videoPage'] : 1;

$offset = ($page - 1) * $perPage;
$videoOffset = ($videoPage - 1) * $perPage;

if ($keyword !== '') {
    // Cari berdasarkan keyword (fungsi searching harus kamu buat)
    $searchResults = searching($conn, $keyword);

    // Pisah hasil search artikel dan video
    $artikels = array_filter($searchResults, fn($k) => strtolower($k['tipe_konten']) === 'artikel');
    $videos = array_filter($searchResults, fn($k) => strtolower($k['tipe_konten']) === 'video');

    // Disable pagination saat search
    $totalPages = $totalVideoPages = 1;
} else {
    // Ambil artikel dan video sesuai pagination
    $totalKonten = getTotalArtikel($conn);
    $totalPages = ceil($totalKonten / $perPage);
    $artikels = tampilkanArtikelTerbaru($conn, $perPage, $offset);

    $totalVideos = getTotalVideos($conn);
    $totalVideoPages = ceil($totalVideos / $perPage);
    $videos = tampilkanVideoTerbaru($conn, $perPage, $videoOffset);
}
?>

<div class="max-w-[1237px] max-h-auto mx-auto px-4 mt-8">

    <!-- Search form -->
    <form action="" method="GET" class="mb-8">
        <div class="w-full bg-stone-300 rounded-lg h-12 flex items-center px-6">
            <span class="material-symbols-outlined mr-4 text-gray-700">search</span>
            <input name="keyword" type="search" placeholder="Cari... " value="<?= $keyword ?>"
                class="w-full h-full bg-transparent border-none focus:outline-none focus:ring-0 text-gray-700 placeholder-gray-500" />
        </div>
    </form>

    <!-- Artikel Section -->
    <div class="flex items-center space-x-2 mb-4">
        <span class="material-symbols-outlined p-6d">menu_book</span>
        <h2 class="text-black text-3xl font-semibold font-poppins">Artikel</h2>
    </div>

    <div class="flex flex-wrap gap-6 justify-center  ">
        <?php if (empty($artikels)): ?>
            <p class="text-gray-500 ml-6 col-span-3">Tidak ada artikel untuk ditampilkan.</p>
        <?php else: ?>
            <?php foreach ($artikels as $artikel): ?>
                <article
                    class=" max-w-[500px] h-full md:w-[30%] rounded-xl overflow-hidden shadow-lg hover:shadow-2xl mb-6 transition-shadow duration-300">
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

    <!-- Pagination Artikel -->
    <?php if ($totalPages > 1 && $keyword === '' && count($artikels) > 0): ?>
        <nav class="mt-5 flex justify-center space-x-3 p-8">
            <?php if ($page > 1): ?>
                <a href="?page=<?= $page - 1 ?>&videoPage=<?= $videoPage ?>&keyword=<?= urlencode($keyword) ?>"
                    class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition">Prev</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i ?>&videoPage=<?= $videoPage ?>&keyword=<?= urlencode($keyword) ?>"
                    class="px-4 py-2 rounded hover:bg-green-600 transition <?= $i === $page ? 'bg-green-700 text-white' : 'bg-green-500 text-white' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <a href="?page=<?= $page + 1 ?>&videoPage=<?= $videoPage ?>&keyword=<?= urlencode($keyword) ?>"
                    class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition">Next</a>
            <?php endif; ?>
        </nav>
    <?php endif; ?>


</div>

<!-- Video Section -->
<div class="max-w-[1237px] mx-auto px-4 mt-8">
    <div class="flex items-center space-x-2 mb-4">
        <span class="material-symbols-outlined p-6d">video_library</span>
        <h2 class="text-black text-3xl font-semibold font-poppins">Video</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 justify-center">
        <?php if (empty($videos)): ?>
            <p class="text-gray-500 ml-6 col-span-3">Tidak ada video untuk ditampilkan.</p>
        <?php else: ?>
            <?php foreach ($videos as $video): ?>
                <?php $video_id = getYoutubeVideoId($video['video_link'] ?? ''); ?>
                <article class="rounded-xl overflow-hidden shadow-lg hover:shadow-2xl mb-5 transition-shadow duration-300">
                    <?php if ($video_id): ?>
                        <div class="relative">
                            <img src="https://img.youtube.com/vi/<?= $video_id ?>/hqdefault.jpg" alt="<?= $video['judul'] ?? '' ?>"
                                class="w-full h-[400px] rounded-t-lg object-cover" />
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span
                                    class="material-symbols-outlined text-white text-6xl bg-black bg-opacity-50 rounded-full p-4">play_circle</span>
                            </div>
                        </div>
                    <?php else: ?>
                        <img src="default.jpg" alt="Default Thumbnail" class="w-full h-[400px] rounded-t-lg object-cover" />
                    <?php endif; ?>
                    <div class="bg-green-950/95 rounded-b-lg p-6">
                        <h3 class="text-white text-2xl font-semibold font-poppins mb-4">
                            <?= $video['judul'] ?? '' ?>
                        </h3>
                        <p class="text-white text-xl font-light font-poppins mb-6 leading-relaxed">
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
                                class="text-white text-xl ml-auto font-light font-poppins whitespace-nowrap">
                                Tonton Video
                            </a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Pagination Video -->
    <?php if ($totalVideoPages > 1 && $keyword === '' && count($videos) > 0): ?>
        <nav class="mt-5 flex justify-center space-x-3 p-8">
            <?php if ($videoPage > 1): ?>
                <a href="?videoPage=<?= $videoPage - 1 ?>&page=<?= $page ?>&keyword=<?= urlencode($keyword) ?>"
                    class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition">Prev</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalVideoPages; $i++): ?>
                <a href="?videoPage=<?= $i ?>&page=<?= $page ?>&keyword=<?= urlencode($keyword) ?>"
                    class="px-4 py-2 rounded hover:bg-green-600 transition <?= $i === $videoPage ? 'bg-green-700 text-white' : 'bg-green-500 text-white' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>

            <?php if ($videoPage < $totalVideoPages): ?>
                <a href="?videoPage=<?= $videoPage + 1 ?>&page=<?= $page ?>&keyword=<?= urlencode($keyword) ?>"
                    class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition">Next</a>
            <?php endif; ?>
        </nav>
    <?php endif; ?>
</div>