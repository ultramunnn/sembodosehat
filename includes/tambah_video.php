<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../config/functions_tambahvidio.php';
require __DIR__ . '/../config/koneksi.php';




$result = proses_tambah_video($conn);
$errors = $result['errors'];
$success = $result['success'];
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
                        <li><?= $e ?></li>
                    <?php endforeach; ?>
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <?php if ($success !== ''): ?>
            <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                <?= $success ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="card-body">
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" name="judul" class="form-control" value="<?= $_POST['judul'] ?? '' ?>" 
                           placeholder="Masukkan judul video" required>
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3" placeholder="Masukkan deskripsi"><?=
                        $_POST['deskripsi'] ?? '' ?></textarea>
                </div>

                <div class="form-group">
                    <label>Link YouTube</label>
                    <input type="text" name="link" placeholder="Masukkan link youtube" class="form-control" value="<?= $_POST['link'] ?? '' ?>">
                </div>

                <div class="form-group">
                    <label>Penyakit Terkait</label>
                    <select name="penyakit_id" class="form-control">
                        <option value="">-- Pilih Penyakit --</option>
                        <?php
                        // Ambil data penyakit dari DB
                        $result = mysqli_query($conn, "SELECT id, nama FROM riwayat_penyakit ORDER BY nama");
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<option value="' . $row['id'] . '">' . $row['nama'] . '</option>';
                        }
                        ?>
                    </select>

                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan Video</button>
            </div>
        </form>
    </div>
</div>