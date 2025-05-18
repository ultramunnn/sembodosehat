<?php
// Contoh data artikel (bisa diganti dengan query DB)
$articles = [
    [
        'title' => '5 Tips Meningkatkan Kesehatan Mental',
        'summary' => 'Temukan cara mudah menjaga keseimbangan mental meski sibuk.',
        'category' => 'Kesehatan Mental',
        'image' => 'https://placehold.co/400x400',
        'link' => '#',
    ],
    [
        'title' => 'Makanan Sehat yang Meningkatkan Imunitas Tubuh',
        'summary' => 'Makanan sehat membuat tubuh anda jadi kuat dan sehat  .',
        'category' => 'Nutrisi',
        'image' => 'https://placehold.co/400x400',
        'link' => '#',
    ],
    [
        'title' => 'Olahraga Ringan yang Bisa Dilakukan Setiap Pagi',
        'summary' => 'Mulai pagi dengan olahraga ringan untuk tubuh fit.',
        'category' => 'Kebugaran',
        'image' => 'https://placehold.co/400x400',
        'link' => '#',
    ],
    [
        'title' => 'Olahraga Ringan yang Bisa Dilakukan Setiap Pagi',
        'summary' => 'Mulai pagi dengan olahraga ringan untuk tubuh fit.',
        'category' => 'Kebugaran',
        'image' => 'https://placehold.co/400x400',
        'link' => '#',
    ],
];
?>

<h2 class="text-black text-4xl font-bold font-poppins mb-6 ml-6 mt-6">Artikel Terbaru</h2>
<section class="w-full max-w-full mx-auto min-h-[700px] bg-transparent px-6 py-8">

    <div
        class="flex gap-6 overflow-x-auto scrollbar-thin scrollbar-thumb-green-500 scrollbar-track-green-300 px-2 py-2">
        <?php foreach ($articles as $article): ?>
            <article
                class="min-w-[380px] rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-300 flex-shrink-0">
                <img src="<?= htmlspecialchars($article['image']) ?>" alt="<?= htmlspecialchars($article['title']) ?>"
                    class="w-full h-[400px] rounded-t-lg object-cover" />
                <div class="bg-green-300 rounded-b-lg p-6">
                    <h3 class="text-white text-2xl font-semibold font-poppins mb-4">
                        <?= htmlspecialchars($article['title']) ?>
                    </h3>
                    <p class="text-white text-xl font-light font-poppins mb-6 leading-relaxed">
                        <?= htmlspecialchars($article['summary']) ?>
                    </p>
                    <div class="border border-white mb-4"></div>
                    <div class="flex items-center gap-6">
                        <span class="bg-green-500 rounded px-3 py-1 text-white text-sm font-light font-poppins">
                            <?= htmlspecialchars($article['category']) ?>
                        </span>
                        <a href="<?= htmlspecialchars($article['link']) ?>"
                            class="text-white text-xl font-light font-poppins underline whitespace-nowrap">
                            [Baca Selengkapnya]
                        </a>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>