<?php
ob_start();
?>
<section class="max-w-full mx-auto px-4 sm:px-6 py-8 grid grid-cols-1 md:grid-cols-1 gap-8 min-h-[400px]">
    <!-- Konten teks dengan background hijau -->
    <div class="bg-green-950/95 p-4 sm:p-8 flex flex-col justify-between rounded-lg shadow-md">
        <div>
            <h3 class="text-white text-lg sm:text-xl font-bold font-poppins mb-4">
                SembodoSehat: Menjadi Lebih Sehat Setiap Hari
            </h3>
            <p class="text-white text-sm sm:text-l font-light font-poppins text-justify mb-2 leading-relaxed">
                SembodoSehat adalah platform yang membantu Anda menjalani gaya hidup
                sehat dengan cara yang mudah dan terjangkau. Kami menyediakan tips
                kebugaran, nutrisi, dan kesehatan mental untuk mendukung kesejahteraan
                Anda. Dengan informasi yang praktis dan panduan yang mudah diterapkan,
                SembodoSehat bertujuan untuk memberdayakan Anda agar lebih sehat,
                bugar, dan bahagia. Apapun tujuan kesehatan Anda—baik itu meningkatkan
                energi, menjaga berat badan, atau menjaga keseimbangan mental—kami
                hadir untuk membantu Anda. Mulailah perjalanan hidup sehat Anda hari
                ini bersama SembodoSehat, tempat di mana kesehatan menjadi prioritas
                utama!
            </p>
        </div>

        <button
            class="w-full md:w-auto bg-green-500/50 px-4 py-2.5 sm:px-6 sm:py-3.5 text-white text-sm font-medium font-poppins hover:bg-green-600 transition rounded-lg">
            Bergabunglah dengan SembodoSehat
        </button>
    </div>
</section>
<?php
$content = ob_get_clean();
include __DIR__ . '/../includes/app.php';
?>
