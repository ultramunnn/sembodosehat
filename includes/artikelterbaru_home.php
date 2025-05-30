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
        /* IE and Edge */
        scrollbar-width: none;
        /* Firefox */
    }

    .hide-scrollbar::-webkit-scrollbar {
        display: none;
        /* Chrome, Safari and Opera */
    }
</style>

<h2 class="p-3 text-black text-2xl font-bold font-poppins ml-6 mt-6">Konten Terbaru</h2>
<section class="w-full max-w-full mx-auto min-h-[600px] bg-transparent px-6 py-2">

    <div class="flex gap-6 overflow-x-auto hide-scrollbar px-2 py-2">
        <?php if (empty($kontens)): ?>
            <p class="text-gray-500 ml-6">Tidak ada konten untuk ditampilkan.</p>
        <?php else: ?>

            <?php foreach ($kontens as $konten): ?>

                <article
                    class="max-w-[500px] h-full rounded-xl overflow-hidden shadow-xl hover:shadow-2xl transition-shadow duration-300 flex-shrink-0">

                    <?php if ($konten['tipe_konten'] === 'Artikel'): ?>
                        <img src="<?= $konten['gambar'] ? '../assets/img/artikel/' . $konten['gambar'] ?? '' : 'default.jpg' ?>"
                            alt="<?= $konten['judul'] ?? '' ?>" class="w-full h-[250px] rounded-t-lg object-cover" />


                    <?php elseif ($konten['tipe_konten'] === 'Video'): ?>
                        <?php
                        $video_id = getYoutubeVideoId($konten['video_link'] ?? '');
                        ?>
                        <?php if ($video_id): ?>
                            <img src="https://img.youtube.com/vi/<?= $video_id ?? '-' ?>/hqdefault.jpg" alt="Thumbnail"
                                class="w-[350] h-[350px] rounded-t-lg object-cover" />

                        <?php else: ?>
                            <img src="default.jpg" alt="Thumbnail" class="w-full h-[400px] rounded-t-lg object-cover" />
                        <?php endif; ?>


                    <?php else: ?>
                        <img src="default.jpg" alt="Thumbnail" class="w-[350px h-[350px] rounded-t-lg object-cover" />
                    <?php endif; ?>


                    <div class="bg-green-950/95 rounded-b-lg p-6">
                        <h3 class="text-white text-xl font-semibold font-poppins mb-4">
                            <?= $konten['judul'] ?? '-' ?>
                        </h3>
                        <p class="text-white text-l font-light font-poppins mb-6 leading-relaxed">
                            <?= $konten['deskripsi'] ?? '-' ?>
                        </p>
                        <div class="border border-white mb-4"></div>
                        <div class="flex items-center gap-2 ">
                            <span class="bg-green-500/50 rounded px-3 py-1 text-white text-sm font-light font-poppins">
                                <?= $konten['tipe_konten'] ?? '-' ?>
                            </span>
                            <span class="bg-green-500/50 rounded px-3 py-1 text-white text-sm font-light font-poppins">
                                <?= $konten['penyakit_nama'] ?? '-' ?>
                            </span>

                            <a href="detail.php?id=<?= $konten['id'] ?? '-' ?>"
                                class="text-white text-l ml-auto font-light font-poppins whitespace-nowrap">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>