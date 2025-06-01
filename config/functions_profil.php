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


?>