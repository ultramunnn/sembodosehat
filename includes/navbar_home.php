<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<div
    class="relative bg-green-950/95 w-full max-w-full h-28 sm:h-32 mx-auto flex flex-wrap items-center px-4 sm:px-8 md:px-32">

    <!-- Logo -->
    <div class="flex justify-center items-center mr-auto md:mr-0">
        <div class="w-16 h-16 sm:w-24 sm:h-24 bg-white rounded-full flex justify-center items-center">
            <img class="w-16 h-10 sm:w-30 sm:h-20" src="../assets/img/logo.png" />
        </div>
    </div>

    <!-- Spacer untuk mendorong hamburger ke kanan -->
    <div class="flex-1 md:hidden"></div>

    <!-- Tombol hamburger mobile -->
    <button id="menu-btn" class="block md:hidden ml-auto focus:outline-none">
        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>

    <!-- Navigasi tengah -->
    <nav id="menu"
        class="hidden md:flex flex-col md:flex-row w-full md:w-auto mt-4 md:mt-0 md:flex-1 md:justify-center absolute md:static left-0 top-full z-20 bg-green-950/95 md:bg-transparent px-4 md:px-0 py-4 md:py-0 rounded-b-lg md:rounded-none shadow md:shadow-none">
        <ul
            class="flex flex-col md:flex-row items-center md:space-x-12 text-white font-poppins text-lg sm:text-2xl font-light">
            <li class="cursor-pointer py-2 md:py-0"><a href="../user/home.php">Home</a></li>
            <li class="cursor-pointer py-2 md:py-0"><a href="../user/profile.php">Profile</a></li>
            <li class="cursor-pointer py-2 md:py-0"><a href="../user/konten.php">Konten</a></li>
            <li class="cursor-pointer py-2 md:py-0"><a href="../user/rekomendasi.php">Rekomendasi</a></li>
            <li class="cursor-pointer py-2 md:py-0"><a href="../user/home.php#tentang">Tentang</a></li>

            <!-- Tombol Login/Logout mobile -->
            <li class="block md:hidden w-full mt-2">
                <?php if (isset($_SESSION['email']) && !empty($_SESSION['email'])): ?>
                    <a href="../logout.php"
                        class="block bg-white rounded-[10px] w-full h-10 px-4 py-2 text-black text-lg font-medium leading-tight font-poppins cursor-pointer hover:bg-gray-200 transition text-center">
                        Logout
                    </a>
                <?php else: ?>
                    <a href="../login.php"
                        class="block bg-white rounded-[10px] w-full h-10 px-4 py-2 text-black text-lg font-medium leading-tight font-poppins cursor-pointer hover:bg-gray-200 transition text-center">
                        Login
                    </a>
                <?php endif; ?>
            </li>
        </ul>
    </nav>

    <!-- Tombol Login/Logout kanan desktop-->
    <div class="ml-auto hidden md:block">
        <?php if (isset($_SESSION['email']) && !empty($_SESSION['email'])): ?>
            <a href="../logout.php"
                class="bg-white rounded-[10px] w-42 h-12 px-4 py-2 text-black text-2xl font-medium leading-tight font-poppins cursor-pointer hover:bg-gray-200 transition">
                Logout
            </a>
        <?php else: ?>
            <a href="../login.php"
                class="bg-white rounded-[10px] w-42 h-12 px-4 py-2 text-black text-2xl font-medium leading-tight font-poppins cursor-pointer hover:bg-gray-200 transition">
                Login
            </a>
        <?php endif; ?>
    </div>
</div>

<script>
    const btn = document.getElementById('menu-btn');
    const menu = document.getElementById('menu');

    btn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });
</script>