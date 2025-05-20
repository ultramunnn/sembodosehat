<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require __DIR__ . '/../config/functions.php';
require __DIR__ . '/../config/koneksi.php';

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'] ?? '';

    // Validasi input
    validate_required($nama, 'nama', $errors);

    // Cek duplikasi
    if (empty($errors) && cek_duplikasi_penyakit($conn, $nama)) {
        $errors['duplikasi'] = 'Penyakit sudah ada';
    }
    //input data
    if (empty($errors)) {
        if (tambah_penyakit($conn, $nama)) {
            header('Location: ../admin/index.php?page=tambah_penyakit&success=1');
            exit();
        }
        var_dump($nama);
        var_dump($errors);
        exit;

    }
} else if (isset($_GET['success'])) {
    $success = 'Penyakit berhasil ditambahkan';
}

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
                        value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>">
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