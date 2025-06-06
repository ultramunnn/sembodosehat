<?php

include 'koneksi.php';
function tambahProfilUser(
    $conn,
    $nama_lengkap,
    $alamat,
    $jenis_kelamin,
    $usia,
    $bio,
    $riwayat_penyakit,
    $foto_profil_path
) {
    if (!isset($_SESSION['email'])) {
        return false;
    }
    $email = $_SESSION['email'];

    $query = "UPDATE users SET 
        nama_lengkap = '$nama_lengkap',
        alamat = '$alamat',
        jenis_kelamin = '$jenis_kelamin',
        usia = '$usia',
        bio = '$bio',
        riwayat_penyakit = '$riwayat_penyakit',
        foto_user = '$foto_profil_path'
        WHERE email = '$email'";

    $result = mysqli_query($conn, $query);
    return $result;
}

function getRiwayatPenyakit($conn)
{
    $query = "SELECT * FROM riwayat_penyakit ORDER BY nama";
    $result = mysqli_query($conn, $query);


    while ($row = mysqli_fetch_assoc($result)) {
        $selected[] = [
            'id' => $row['id'],
            'nama' => $row['nama']
        ];
    }
    return $selected;
}

function getJenisKelamin($conn)
{
    return [
        ['jenis_kelamin' => 'Laki-laki'],
        ['jenis_kelamin' => 'Perempuan']
    ];
}

function prosesUpdateProfil($conn, $post_data, $files)
{
    $nama_lengkap = $post_data['namaLengkap'] ?? '';
    $alamat = $post_data['alamat'] ?? '';
    $jenis_kelamin = $post_data['jenisKelamin'] ?? '';
    $usia = $post_data['usia'] ?? '';
    $bio = $post_data['bio'] ?? '';
    $riwayat_penyakit = $post_data['riwayatPenyakit'] ?? '';
    $foto_profil_path = '';

    // Process photo upload if exists
    if (isset($files['fotoProfil']) && $files['fotoProfil']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $fileName = uniqid() . '_' . basename($files['fotoProfil']['name']);
        $targetFile = $uploadDir . $fileName;
        if (move_uploaded_file($files['fotoProfil']['tmp_name'], $targetFile)) {
            $foto_profil_path = 'uploads/' . $fileName;
        }
    }

    // Call tambahProfilUser with collected data
    return tambahProfilUser($conn, $nama_lengkap, $alamat, $jenis_kelamin, $usia, $bio, $riwayat_penyakit, $foto_profil_path);
}


?>