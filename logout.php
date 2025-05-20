<?php
function logout()
{
    // Mulai session jika belum aktif
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Hapus semua data session
    $_SESSION = [];

    // Hapus cookie session jika ada
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    // Hancurkan session
    session_destroy();

    // Redirect ke halaman login
    header("Location: ../login.php");
    exit();
}

// Jalankan logout langsung saat file ini diakses
logout();
