<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include __DIR__ . '/config/auth.php';

$pageTitle = "Login & Signup";

$baseUrl = "/sembodosehat";

$message = '';
$email = '';
$password = '';

// Proses form sign in
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'signin') {
    $email = trim($_POST['signinEmail'] ?? '');
    $password = $_POST['signinPassword'] ?? '';

    if ($email === '' || $password === '') {
        $message = '<div class="alert alert-danger">Email dan Password wajib diisi.</div>';
    } else {
        $password_md5 = md5($password);

        if (login($email, $password_md5)) {
            header("Location: $baseUrl/admin/dashboard.php");
            exit;
        } else {
            $message = '<div class="alert alert-danger">Email atau Password salah.</div>';
        }
    }
}


$content = <<<HTML
<div class="container-auth">
  <!-- Sign In -->
  <div class="auth-box left-box">
    <h2>Sign In</h2>
    $message
    <form method="POST" action="">
      <input type="hidden" name="action" value="signin" />
      <div class="mb-3">
        <label for="signinEmail" class="form-label">Email address</label>
        <input type="email" class="form-control" id="signinEmail" name="signinEmail" placeholder="Masukkan email" value="{$email}"  />
      </div>
      <div class="mb-3">
        <label for="signinPassword" class="form-label">Password</label>
        <input type="password" class="form-control" id="signinPassword" name="signinPassword" placeholder="Masukkan password" />
      </div>
      <button type="submit" class="btn btn-primary-custom w-100">Sign In</button>
    </form>
  </div>

  <!-- Sign Up -->
  <div class="auth-box right-box">
    <h2>Sign Up</h2>
    <p>Untuk saat ini fitur pendaftaran belum tersedia.</p>
  </div>
</div>
HTML;

include __DIR__ . '/includes/app_login.php';
?>