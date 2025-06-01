<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include __DIR__ . '/config/auth.php';

$pageTitle = "Login & Signup";

$baseUrl = "/sembodosehat";

$message = '';
$email = '';
$password = '';
$signupNama = '';
$signupEmail = '';

// Proses form sign in
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
  if ($_POST['action'] === 'signin') {
    $email = trim($_POST['signinEmail'] ?? '');
    $password = $_POST['signinPassword'] ?? '';

    if ($email === '' || $password === '') {
      $message = '<div class="alert alert-danger">Email dan Password wajib diisi.</div>';
    } else {
      if (login($email, $password)) {
        // Saat login berhasil
        $_SESSION['email'] = $email; // email user yang login
        $_SESSION['nama'] = $nama;   // nama user yang login

        // Redirect berdasarkan role
        if ($_SESSION['user_role'] === 'admin') {
          header("Location: $baseUrl/admin/index.php");
          exit;
        } else {
          header("Location: $baseUrl/user/home.php");
          exit;
        }
      } else {
        $message = '<div class="alert alert-danger">Email atau Password salah.</div>';
      }
    }
  } elseif ($_POST['action'] === 'signup') {
    $signupNama = $_POST['signupNama'] ?? '';
    $signupEmail = $_POST['signupEmail'] ?? '';
    $signupPassword = $_POST['signupPassword'] ?? '';

    if ($signupNama === '' || $signupEmail === '' || $signupPassword === '') {
      $message = '<div class="alert alert-danger">Semua field pendaftaran wajib diisi.</div>';
    } else {
      // Cek email valid (simple validation)
      if (!filter_var($signupEmail, FILTER_VALIDATE_EMAIL)) {
        $message = '<div class="alert alert-danger">Email tidak valid.</div>';
      } else {
        // Panggil fungsi signupUser (kamu harus sudah punya fungsi ini di auth.php)
        $signupResult = signupUser($signupNama, $signupEmail, $signupPassword);
        if ($signupResult === true) {
          $message = '<div class="alert alert-success">Pendaftaran berhasil! Silakan login.</div>';
          // Kosongkan input signup agar form bersih
          $signupNama = '';
          $signupEmail = '';
        } else {
          $message = '<div class="alert alert-danger">' . htmlspecialchars($signupResult) . '</div>';
        }
      }
    }
  }
}

$content = <<<HTML
<div class="flex h-screen bg-gray-800 m-0 p-0">
  <!-- Sign In -->
  <div class="w-1/2 bg-[#4CAF50] flex flex-col justify-center items-center p-8">
    <h1 class="text-3xl font-bold text-white mb-6">Selamat Datang</h1>
    $message
    <form method="POST" action="" class="w-full max-w-sm">
      <input type="hidden" name="action" value="signin" />
      <div class="mb-4">
        <label for="signinEmail" class="block text-white text-sm font-bold mb-2">Email</label>
        <input type="email" name="signinEmail" placeholder="Masukkan email" value="{$email}" required
        class="shadow appearance-none border rounded w-full py-2 px-3 bg-white text-black leading-tight focus:outline-none focus:ring-2 focus:ring-green-400" />

      </div>
      <div class="mb-6">
        <label for="signinPassword" class="block text-white text-sm font-bold mb-2">Password</label>
        <input type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-blackleading-tight focus:outline-none focus:ring-2 focus:ring-green-400"" id="signinPassword" name="signinPassword" placeholder="Masukkan password" required />
      </div>
      <button type="submit" class="bg-[#A5D6A7] text-white font-bold py-2 px-4 rounded w-full">Sign In</button>
    </form>
  </div>

  <!-- Sign Up -->
  <div class="w-1/2 bg-[#A5D6A7] flex flex-col justify-center items-center p-8">
    <h1 class="text-3xl font-bold text-white mb-6">Buat Akun</h1>
    <form method="POST" action="" class="w-full max-w-sm">
      <input type="hidden" name="action" value="signup" />
      <div class="mb-4">
        <label for="signupNama" class="block text-white text-sm font-bold mb-2">Nama</label>
        <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-blaack leading-tight focus:outline-none focus:ring-2 focus:ring-green-400"" id="signupNama" name="signupNama" placeholder="Masukkan Nama" value="{$signupNama}" required />
      </div>
      <div class="mb-4">
        <label for="signupEmail" class="block text-white text-sm font-bold mb-2">Email</label>
        <input type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-blackleading-tight focus:outline-none focus:ring-2 focus:ring-green-400"" id="signupEmail" name="signupEmail" placeholder="Masukkan email" value="{$signupEmail}" required />
      </div>
      <div class="mb-6">
        <label for="signupPassword" class="block text-white text-sm font-bold mb-2">Password</label>
        <input type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:ring-2 focus:ring-green-400"" id="signupPassword" name="signupPassword" placeholder="Masukkan password" required />
      </div>
      <button type="submit" class="bg-[#4CAF50] text-white font-bold py-2 px-4 rounded w-full ">Sign Up</button>
    </form>
  </div>
</div>
HTML;

// Jangan tampilkan navbar dan footer di halaman login
$showNavbar = false;
$showFooter = false;

include __DIR__ . '/includes/app.php';
