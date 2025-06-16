<?php
// fungsi untuk menampilkan artikel
function getArtikelById($conn, $id) {
    $id = (int)$id;
    if ($id <= 0) return false;

    $query = "SELECT * FROM konten WHERE id = $id AND tipe_konten = 'Artikel'";
    $result = mysqli_query($conn, $query);

    if (!$result) return false;

    $artikel = mysqli_fetch_assoc($result);
    return $artikel ?: false;
}
?>
