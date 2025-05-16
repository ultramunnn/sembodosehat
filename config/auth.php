<?php
session_start();
include_once __DIR__ . '/koneksi.php';


function login($email, $password_plain)
{
    global $conn;

    // Cek dulu di tabel admins
    $stmt = $conn->prepare("SELECT id, nama, email, password FROM admins WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $admin = $result->fetch_assoc();
        var_dump($admin); // debug data admin

        // Verifikasi password hash
        if (password_verify($password_plain, $admin['password'])) {
            $_SESSION['user_id'] = $admin['id'];
            $_SESSION['user_name'] = $admin['nama'];
            $_SESSION['user_role'] = 'admin';
            return true;
        }
    }

    // Jika tidak ditemukan di admins, cek di tabel users
    $stmt = $conn->prepare("SELECT id, nama, email, password FROM users WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password_plain, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nama'];
            $_SESSION['user_role'] = 'user';
            return true;
        }
    }

    // Jika email tidak ditemukan atau password salah
    return false;
}


function signupAdmin($nama, $email, $password_plain)
{
    global $conn;

    // Cek email sudah dipakai admin atau belum
    $stmt = $conn->prepare("SELECT id FROM admins WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        return "Email admin sudah terdaftar";
    }

    // Hash password dengan bcrypt
    $password_hash = password_hash($password_plain, PASSWORD_DEFAULT);

    // Insert data admin baru
    $stmt = $conn->prepare("INSERT INTO admins (nama, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nama, $email, $password_hash);

    if ($stmt->execute()) {
        return true;
    } else {
        return "Gagal mendaftar admin: " . $conn->error;
    }
}

function signupUser($nama, $email, $password_plain)
{
    global $conn;

    // Cek email sudah dipakai user atau belum
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        return "Email user sudah terdaftar";
    }

    // Hash password dengan bcrypt
    $password_hash = password_hash($password_plain, PASSWORD_DEFAULT);

    // Insert data user baru
    $stmt = $conn->prepare("INSERT INTO users (nama, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nama, $email, $password_hash);

    if ($stmt->execute()) {
        return true;
    } else {
        return "Gagal mendaftar user: " . $conn->error;
    }
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
