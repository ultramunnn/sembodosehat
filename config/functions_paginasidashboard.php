<?php 
// Fungsi paginasi modular untuk dashboard
function getPaginatedKonten($conn, $penyakit_id = null, $page = 1, $perPage = 10, &$totalPages = 1, &$totalKonten = 0, $startNumber = 1) {
    $offset = ($page - 1) * $perPage;
    $stmt = null;
    
    if (empty($penyakit_id)) {
        // Query untuk semua konten
        $countSql = "SELECT COUNT(*) as total FROM konten k WHERE k.tipe_konten IN ('artikel','video')";
        $result = mysqli_query($conn, $countSql);
        
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $totalKonten = (int)$row['total'];
            $totalPages = max(1, ceil($totalKonten / $perPage));
        }

        // Query untuk data tanpa filter penyakit
        $sql = "SELECT DISTINCT k.* FROM konten k 
                WHERE k.tipe_konten IN ('artikel','video')
                ORDER BY k.id ASC LIMIT $offset, $perPage";
        $result = mysqli_query($conn, $sql);
    } else {
        $penyakit_id = (int)$penyakit_id;
        
        // Query untuk total konten penyakit spesifik
        $countSql = "SELECT COUNT(DISTINCT k.id) as total 
                     FROM konten k 
                     JOIN konten_penyakit kp ON k.id = kp.konten_id 
                     WHERE kp.penyakit_id = $penyakit_id 
                     AND k.tipe_konten IN ('artikel','video')";
        
        $countResult = mysqli_query($conn, $countSql);
        
        if ($countResult) {
            $row = mysqli_fetch_assoc($countResult);
            $totalKonten = (int)$row['total'];
            $totalPages = max(1, ceil($totalKonten / $perPage));
        }

        // Query untuk data penyakit spesifik
        $sql = "SELECT DISTINCT k.* 
                FROM konten k 
                JOIN konten_penyakit kp ON k.id = kp.konten_id 
                WHERE kp.penyakit_id = $penyakit_id 
                AND k.tipe_konten IN ('artikel','video') 
                ORDER BY k.id ASC 
                LIMIT $offset, $perPage";
        $result = mysqli_query($conn, $sql);
    }

    // proses hasil query
    if ($result) {
        $kontens = [];
        $no = $startNumber + $offset;
        while ($k = mysqli_fetch_assoc($result)) {
            if (isset($k['isi_artikel'])) {
                $stripped = strip_tags($k['isi_artikel']);
                $k['isi_artikel'] = strlen($stripped) > 100 ? substr($stripped, 0, 100) . '...' : $stripped;
            }
            $k['nomor'] = $no++;
            $kontens[] = $k;
        }
        
        return $kontens;
    }
    
    return [];
}
?>
