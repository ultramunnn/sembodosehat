<?php
include 'koneksi.php';
function tambahProfilUser(
    $conn,
    $nama_lengkap,
    $alamat,
    $jenis_kelamin,
    $usia,
    $bio,
    $penyakit_id, // ganti dari $riwayat_penyakit
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
        penyakit_id = '$penyakit_id',
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
    $penyakit_id = $post_data['riwayatPenyakit'] ?? '';
    $foto_profil_path = $post_data['foto_lama'] ?? ''; // Gunakan foto lama sebagai default

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

    // validasi input
    return tambahProfilUser($conn, $nama_lengkap, $alamat, $jenis_kelamin, $usia, $bio, $penyakit_id, $foto_profil_path);
}

function getUserProfile($conn, $email) {
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}

function getNamaPenyakit($conn, $penyakit_id) {
    $query = "SELECT nama FROM riwayat_penyakit WHERE id = '$penyakit_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row ? $row['nama'] : '';
}

?>