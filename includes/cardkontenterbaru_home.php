<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include __DIR__ . '/../config/koneksi.php';
include __DIR__ . '/../config/functions_kontenhome.php';

$kontens = tampilkanKontenTerbaru($conn, 10); // ambil 10 konten terbaru
?>

<style>
    .hide-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    .hide-scrollbar::-webkit-scrollbar {
        display: none;
    }

      /* Efek hover timbul pada card */
    .card:hover {
        transform: scale(1.05); /* Memberikan efek membesar */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); /* Efek bayangan */
        transition: transform 0.3s ease, box-shadow 0.3s ease; /* Memperhalus transisi */
    }
</style>

<h2 class="p-3 text-black text-2xl font-bold font-poppins ml-6 mt-6">Konten Terbaru</h2>
<section class="w-full max-w-full mx-auto min-h-[600px] bg-transparent px-4 sm:px-6 py-2">
    <div class="flex gap-4 sm:gap-6 overflow-x-auto hide-scrollbar px-2 py-2 items-stretch">
        <?php if (empty($kontens)): ?>
            <p class="text-gray-500 ml-6">Tidak ada konten untuk ditampilkan.</p>
        <?php else: ?>
            <?php foreach ($kontens as $konten): ?>
                <article class="max-w-[300px] sm:max-w-[350px] h-full rounded-xl overflow-hidden shadow-xl hover:shadow-2xl transition-shadow duration-300 flex-shrink-0 flex flex-col card">
                    <!-- Gambar konten dengan tinggi tetap -->
                    <?php if ($konten['tipe_konten'] === 'Artikel'): ?>
                        <div class="h-48 sm:h-56 w-full">
                            <img src="<?= $konten['gambar'] ? '../assets/img/artikel/' . $konten['gambar'] ?? '' : 'default.jpg' ?>"
                                 alt="<?= $konten['judul'] ?? '' ?>" 
                                 class="w-full h-full object-cover" />
                        </div>
                    <?php elseif ($konten['tipe_konten'] === 'Video'): ?>
                        <?php $video_id = getYoutubeVideoId($konten['video_link'] ?? ''); ?>
                        <div class="h-48 sm:h-56 w-full">
                            <?php if ($video_id): ?>
                                <img src="https://img.youtube.com/vi/<?= $video_id ?? '-' ?>/hqdefault.jpg" 
                                     alt="Thumbnail"
                                     class="w-full h-full object-cover" />
                            <?php else: ?>
                                <img src="default.jpg" alt="Thumbnail" class="w-full h-full object-cover" />
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        <div class="h-48 sm:h-56 w-full">
                            <img src="default.jpg" alt="Thumbnail" class="w-full h-full object-cover" />
                        </div>
                    <?php endif; ?>

                    <!-- Konten detail dengan tinggi fleksibel -->
                    <div class="flex-grow bg-green-950/95 p-4 sm:p-6 flex flex-col">
                        <h3 class="text-white text-lg sm:text-xl font-semibold font-poppins mb-3 line-clamp-2">
                            <?= $konten['judul'] ?? '-' ?>
                        </h3>
                        <div class="flex-grow">
                            <p class="text-white text-sm sm:text-base font-light font-poppins leading-relaxed line-clamp-3">
                                <?= $konten['deskripsi'] ?? '-' ?>
                            </p>
                        </div>
                        
                        <div class="border border-white my-3"></div>
                        
                        <div class="flex justify-between items-center">
                            <div class="flex flex-wrap gap-2">
                                <span class="bg-green-500/50 rounded px-2 py-1 text-white text-xs sm:text-sm font-light font-poppins">
                                    <?= $konten['tipe_konten'] ?? '-' ?>
                                </span>
                                <span class="bg-green-500/50 rounded px-2 py-1 text-white text-xs sm:text-sm font-light font-poppins">
                                    <?= $konten['penyakit_nama'] ?? '-' ?>
                                </span>
                            </div>
                            
                            <a href="<?= $konten['tipe_konten'] === 'Video' ? 'home.php?page=tampilan_video&id=' . ($konten['id'] ?? '') : 'home.php?page=tampilan_artikel&id=' . ($konten['id'] ?? '') ?>"
                               class="text-white text-xs sm:text-sm font-light font-poppins whitespace-nowrap">
                                <?= $konten['tipe_konten'] === 'Video' ? 'Tonton Video' : 'Baca Selengkapnya' ?>
                            </a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>