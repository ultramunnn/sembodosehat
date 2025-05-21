<?php
session_start();
include __DIR__ . '/../config/koneksi.php';
include __DIR__ . '/../config/functions.php';
include __DIR__ . '/../config/functions_tambahartikel.php';

$result = proses_tambah_artikel($conn);
$errors = $result['errors'];
$success = $result['success'];

?>

<div class="content-wrapper">
    <div class="card card-primary m-5">
        <div class="card-header">
            <h3 class="card-title">Tambah Artikel</h3>
        </div>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger mt-2">
                <ul class="mb-0">
                    <?php foreach ($errors as $err): ?>
                        <li><?= $err ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert alert-success mt-2"><?= $sucess?></div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data" action="">
            <div class="card-body">

                <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul" placeholder="Enter judul"
                        value="<?= $_POST['judul']?? '' ?>">
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Enter deskripsi"
                        rows="4"><?= $_POST['deskripsi'] ?? '' ?></textarea>
                </div>

                <div class="form-group">
                    <label for="gambar">Gambar</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="gambar" name="gambar">
                            <label class="custom-file-label" for="gambar">Pilih gambar</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="isi_artikel">Isi Artikel</label>
                    <textarea class="form-control" id="isi_artikel" name="isi_artikel" placeholder="Enter isi artikel"
                        rows="6"><?= $_POST['isi_artikel'] ?? '' ?></textarea>
                </div>

                <div class="form-group">
                    <label for="penyakit">Penyakit</label>
                    <select class="form-control " id="penyakit" name="penyakit" style="width: 100%;">
                        <option value="">-- Pilih Penyakit --</option>
                        <?php
                        // Ambil data penyakit dari DB
                        $result = mysqli_query($conn, "SELECT id, nama FROM riwayat_penyakit ORDER BY nama");
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<option value="' . $row['id'] ?? '' . '">' . $row['nama'] ?? '' . '</option>';
                        }
                        ?>
                        </option>


                    </select>
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Agar nama file upload tampil saat pilih file (Bootstrap custom-file-input)
    document.querySelector('.custom-file-input').addEventListener('change', function (e) {
        var fileName = document.getElementById("gambar").files[0].name;
        this.nextElementSibling.innerText = fileName;
    });
</script>