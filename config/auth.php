<?php
session_start();
include_once __DIR__ . '/koneksi.php';

function login($email, $password_md5)
{
    global $conn;

    $stmt = $conn->prepare("SELECT id, nama_lengkap, email FROM admin WHERE email = ? AND password_hash = ? LIMIT 1");
    $stmt->bind_param("ss", $email, $password_md5);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Set session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['nama_lengkap'];

        return true;
    }
    return false;
}

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

    // Bisa redirect ke halaman login atau home
    header("Location: /sembodosehat/login.php");
    exit();
}
