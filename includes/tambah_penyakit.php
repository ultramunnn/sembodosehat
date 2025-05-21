<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require __DIR__ . '/../config/functions_tambahpenyakit.php';
require __DIR__ . '/../config/koneksi.php';

$result = proses_tambah_penyakit($conn);
$errors = $result['errors'];
$success = $result['success'];
?>

<div class="content-wrapper">

    <div class="card card-primary m-5">
        <div class="card-header">

            <h3 class="card-title">Tambah Riwayat Penyakit</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <!-- Menampilkan pesan kesalahan atau sukses -->
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

        <!-- success -->
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
                    <label for="penyakit">Nama Penyakit</label>
                    <input type="text" name="nama" class="form-control" id="penyakit" placeholder="Enter penyakit"
                        value="<?= $_POST['nama'] ?? '' ?>">
                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </div>
        </form>
    </div>
</div>
<!-- /.card -->