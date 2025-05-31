<?php 
// Fungsi paginasi modular untuk dashboard
function getPaginatedKonten($conn, $penyakit_id, $page = 1, $perPage = 10, &$totalPages = 1, &$totalKonten = 0, $startNumber = 1) {
    $offset = ($page - 1) * $perPage;
    // Hitung total konten
    $countSql = "SELECT COUNT(*) as total FROM konten k JOIN konten_penyakit kp ON k.id = kp.konten_id WHERE kp.penyakit_id = $penyakit_id AND k.tipe_konten IN ('artikel','video')";
    $countResult = mysqli_query($conn, $countSql);
    if ($countResult) {
        $row = mysqli_fetch_assoc($countResult);
        $totalKonten = (int)$row['total'];
        $totalPages = max(1, ceil($totalKonten / $perPage));
    }
    // Query data dengan LIMIT dan OFFSET
    $sql = "
        SELECT k.*
        FROM konten k
        JOIN konten_penyakit kp ON k.id = kp.konten_id
        WHERE kp.penyakit_id = $penyakit_id 
        AND k.tipe_konten IN ('artikel','video')
        ORDER BY k.id ASC
        LIMIT $perPage OFFSET $offset
    ";
    $result = mysqli_query($conn, $sql);
    $kontens = [];
    if ($result) {
        $no = $startNumber + $offset;
        while ($k = mysqli_fetch_assoc($result)) {
            // Batasi isi artikel hanya sedikit (misal 100 karakter)
            if (isset($k['isi_artikel'])) {
                $k['isi_artikel'] = mb_strimwidth(strip_tags($k['isi_artikel']), 0, 100, '...');
            }
            $k['nomor'] = $no;
            $kontens[] = $k;
            $no++;
        }
    }
    return $kontens;
}

?>
