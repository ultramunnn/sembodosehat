<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include 'koneksi.php';

// Fungsi untuk memvalidasi input artikel
function validate_artikel_input(array &$errors)
{
    $required_fields = ['judul', 'deskripsi', 'isi_artikel', 'penyakit'];

    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[$field] = $field . ' tidak boleh kosong';
        }
    }

    // Validasi file gambar jika ada
    if (!isset($_FILES['gambar']) || $_FILES['gambar']['error'] !== UPLOAD_ERR_OK) {
        $errors['gambar'] = 'Gambar wajib diupload';
    }
}


// Fungsi untuk mengecek duplikasi judul artikel
function cek_duplikasi_artikel($conn)
{
    $judul = $_POST['judul'];
    $sql = "SELECT id FROM konten WHERE judul = '$judul' AND tipe_konten = 'artikel'";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result) > 0;
}

function tambah_artikel($conn)
{
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $isi_artikel = $_POST['isi_artikel'];
    $penyakit_id = intval($_POST['penyakit']);

    // Upload gambar
    $gambar = $_FILES['gambar']['name'];
    $target_dir = "../assets/img/artikel/";
    $target_file = $target_dir . basename($gambar);
    if (!move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
        return false;
    }

    // Insert ke tabel konten
    $sql = "INSERT INTO konten (judul, deskripsi, gambar, tipe_konten, isi_artikel)
            VALUES ('$judul', '$deskripsi', '$gambar', 'artikel', '$isi_artikel')";

    if (!mysqli_query($conn, $sql)) {
        return false;
    }

    $konten_id = mysqli_insert_id($conn);

    // Insert ke relasi konten_penyakit
    $sql_rel = "INSERT INTO konten_penyakit (konten_id, penyakit_id) VALUES ($konten_id, $penyakit_id)";
    if (!mysqli_query($conn, $sql_rel)) {
        return false;
    }

    return true;
}



// Fungsi untuk memproses penambahan artikel
function proses_tambah_artikel($conn)
{
    $errors = [];
    $success = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        validate_artikel_input($errors);

        if (empty($errors) && cek_duplikasi_artikel($conn)) {
            $errors['duplikasi'] = 'Judul artikel sudah ada';
        }

        if (empty($errors)) {
            if (tambah_artikel($conn)) {
                header('Location: ../admin/index.php?page=tambah_artikel&success=1');
                exit();
            } else {
                $errors['database'] = 'Gagal menyimpan artikel: ' . mysqli_error($conn);
            }
        }
    } elseif (isset($_GET['success'])) {
        $success = 'Artikel berhasil ditambahkan';
    }

    return ['errors' => $errors, 'success' => $success];
}


// Fungsi untuk menampilkan daftar artikel
function tampilkan_artikel($conn)
{
    $sql = "SELECT * FROM konten WHERE tipe_konten = 'artikel' ORDER BY id ASC";
    ;
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function hapus_artikel($conn, $id)
{
    $id = (int) $id;

    // Hapus relasi dulu
    $sql_rel = "DELETE FROM konten_penyakit WHERE konten_id = $id";
    if (!mysqli_query($conn, $sql_rel)) {
        echo "Error hapus relasi: " . mysqli_error($conn);
        return false;
    }

    // Baru hapus konten
    $sql = "DELETE FROM konten WHERE id = $id AND tipe_konten = 'Artikel'";
    if (!mysqli_query($conn, $sql)) {
        echo "Error hapus konten: " . mysqli_error($conn);
        return false;
    }

    return true;
}



?>