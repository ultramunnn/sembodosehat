<?php
session_start();
include_once __DIR__ . '/koneksi.php';


function login($email, $password)
{
    global $conn;


    // Cek di tabel admins
    $sql = "SELECT id, nama, email, password FROM admins WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) === 1) {
        $admin = mysqli_fetch_assoc($result);
        if (password_verify($password, $admin['password'])) {
            $_SESSION['user_id'] = $admin['id'];
            $_SESSION['user_name'] = $admin['nama'];
            $_SESSION['user_role'] = 'admin';
            return true;
        }
    }

    // Cek di tabel users
    $sql = "SELECT id, nama, email, password FROM users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nama'];
            $_SESSION['user_role'] = 'user';
            return true;
        }
    }

    return false;
}




function signupUser($nama, $email, $password)
{
    global $conn;

    $nama = $_POST['signupNama'];
    $email = $_POST['signupEmail'];

    // Cek email sudah dipakai user atau belum
    $sql = "SELECT id FROM users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        return "Email user sudah terdaftar";
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);


    $sql = "INSERT INTO users (nama, email, password) VALUES ('$nama', '$email', '$password_hash')";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return "Gagal mendaftar user: " . mysqli_error($conn);
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




