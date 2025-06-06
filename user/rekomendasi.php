<?php
session_start();
include '../config/koneksi.php';
include '../config/functions_profil.php';

$user = getUserProfile($conn, $_SESSION['email']);
$penyakit_id = $user['penyakit_id']; // contoh: 1,2,3

// Bersihkan dan validasi ID
$ids = array_filter(array_map('trim', explode(',', $penyakit_id)), 'is_numeric');
if (count($ids) > 0) {
    $in = implode(',', $ids);
    $query = "
        SELECT k.*
        FROM konten k
        JOIN konten_penyakit kp ON k.id = kp.konten_id
        WHERE kp.penyakit_id IN ($in)
        GROUP BY k.id
    ";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        // tampilkan rekomendasi
        echo "<div>{$row['judul']}</div>";
    }
} else {
    echo "<div>Tidak ada rekomendasi sesuai riwayat penyakit Anda.</div>";
}
?>