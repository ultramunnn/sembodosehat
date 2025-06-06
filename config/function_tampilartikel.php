<?php
function getArtikelById($conn, $id) {
    $id = (int)$id;
    if ($id <= 0) return false;

    $query = "SELECT * FROM konten WHERE id = ? AND tipe_konten = 'Artikel'";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) return false;

    $artikel = $result->fetch_assoc();
    return $artikel ?: false;
}
