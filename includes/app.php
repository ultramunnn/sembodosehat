<?php
// includes/app.php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!isset($pageTitle))
    $pageTitle = "SembodoSehat";

if (!isset($content))
    $content = "<p>Konten belum tersedia.</p>";

// Opsi: tampilkan navbar dan footer (true/false)
if (!isset($showNavbar))
    $showNavbar = true;

if (!isset($showFooter))
    $showFooter = true;
?>

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= htmlspecialchars($pageTitle) ?></title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />


    <!-- icon -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />


</head>

<body class="p-0 m-0">

    <?php if ($showNavbar): ?>
        <?php include __DIR__ . '/navbar_home.php'; ?>
    <?php endif; ?>

    <main class="<?= $showNavbar ?>">
        <div class="min-h-screen"><?= $content ?></div>
    </main>

    <?php if ($showFooter): ?>
        <footer class="bg-green-950/95 w-full py-6 px-4 sm:px-32 flex flex-wrap items-center justify-between gap-4">
            <!-- Kiri: Logo -->
            <div class="flex justify-center items-center">
                <div class="w-10 h-10 sm:w-15 sm:h-15 bg-white rounded-full flex justify-center items-center">
                    <img class="w-10 h-10 sm:w-15 sm:h-15" src="../assets/img/logo.png" />
                </div>
            </div>
            <!-- Tengah: Copyright -->
            <div
                class="flex flex-col md:flex-row gap-4 md:gap-12 text-white font-poppins text-sm sm:text-lg font-medium leading-snug">
                <div>Copyright © 2025 SembodoSehat</div>
                <div>All Rights Reserved</div>
            </div>

            <!-- Kanan: Ikon sosial media -->
            <div class="flex items-center gap-6">
                <!-- Instagram -->
                <a href="#" aria-label="Instagram" class="w-6 h-6">
                    <img src="https://cdn-icons-png.flaticon.com/512/174/174855.png" alt="Instagram"
                        class="w-full h-full object-contain" />
                </a>
                <!-- WhatsApp -->
                <a href="#" aria-label="WhatsApp" class="w-6 h-6">
                    <img src="https://cdn-icons-png.flaticon.com/512/733/733585.png" alt="WhatsApp"
                        class="w-full h-full object-contain" />
                </a>
                <!-- Facebook -->
                <a href="#" aria-label="Facebook" class="w-6 h-6">
                    <img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="Facebook"
                        class="w-full h-full object-contain" />
                </a>
            </div>
        </footer>


    <?php endif; ?>

</body>

</html>