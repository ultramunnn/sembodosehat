<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../config/functions_tambahvidio.php';
require __DIR__ . '/../config/koneksi.php';

$errors = [];
$success = '';

// Ambil data penyakit dari database
$sql_penyakit = "SELECT id, nama FROM riwayat_penyakit";
$result_penyakit = mysqli_query($conn, $sql_penyakit);
$list_penyakit = [];
if ($result_penyakit) {
    $list_penyakit = mysqli_fetch_all($result_penyakit, MYSQLI_ASSOC);
} else {
    $errors['database'] = 'Gagal memuat data penyakit: ' . mysqli_error($conn);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Panggil fungsi validasi
    validate_video_input($errors);
    
    // Cek duplikasi video
    if (empty($errors) && cek_duplikasi_video($conn)) {
        $errors['duplikasi'] = 'Link video sudah terdaftar';
    }

    // Proses penyimpanan data
    if (empty($errors)) {
        if (tambah_video($conn)) {
            header('Location: ../admin/index.php?page=tambah_video&success=1');
            exit();
        } else {
            $errors['database'] = 'Gagal menyimpan data: ' . mysqli_error($conn);
        }
    }
} elseif (isset($_GET['success'])) {
    $success = 'Video berhasil ditambahkan';
}
?>

<div class="content-wrapper">
    <div class="card card-primary m-5">
        <div class="card-header">
            <h3 class="card-title">Tambah Video</h3>
        </div>
        
        <!-- Menampilkan pesan error/sukses -->
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                <ul class="mb-0">
                    <?php foreach ($errors as $e): ?>
                        <li><?= htmlspecialchars($e) ?></li>
                    <?php endforeach; ?>
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <?php if ($success !== ''): ?>
            <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                <?= htmlspecialchars($success) ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="card-body">
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" name="judul" class="form-control" 
                        value="<?= htmlspecialchars($_POST['judul'] ?? '') ?>">
                </div>
                
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3"><?= 
                        htmlspecialchars($_POST['deskripsi'] ?? '') ?></textarea>
                </div>
                
                <div class="form-group">
                    <label>Link YouTube</label>
                    <input type="text" name="link" class="form-control"
                        value="<?= htmlspecialchars($_POST['link'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label>Penyakit Terkait</label>
                    <select name="id" class="form-control">
                        <option value="">Pilih Penyakit</option>
                        <?php foreach ($list_penyakit as $penyakit): ?>
                            <option value="<?= $penyakit['id'] ?>"
                                <?= ($_POST['id'] ?? '') == $penyakit['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($penyakit['nama']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan Video</button>
            </div>
        </form>
    </div>
</div>