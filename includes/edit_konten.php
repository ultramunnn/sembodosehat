<?php
// Include database connection
require_once __DIR__ . '/../config/koneksi.php';
require_once __DIR__ . '/../config/functions_editkonten.php';

// Get content data
$content = editKonten($_GET['id']);

?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Konten</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Edit Konten</h3>
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($content['id']) ?>">

                        <div class="form-group">
                            <label>Tipe Konten</label>
                            <select class="form-control" name="tipe_konten" id="tipeKonten" readonly disabled>
                                <option value="artikel" <?= $content['tipe_konten'] == 'artikel' ? 'selected' : '' ?>>
                                    Artikel</option>
                                <option value="video" <?= $content['tipe_konten'] == 'video' ? 'selected' : '' ?>>Video
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" class="form-control" name="judul"
                                value="<?= htmlspecialchars($content['judul']) ?>" required>
                        </div>

                        <div id="artikelFields"
                            style="display: <?= $content['tipe_konten'] == 'artikel' ? 'block' : 'none' ?>">
                            <div class="form-group">
                                <label>Isi Artikel</label>
                                <textarea class="form-control" name="isi_artikel"
                                    rows="10"><?= htmlspecialchars($content['isi_artikel']) ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Gambar Artikel</label>
                                <?php if ($content['gambar']): ?>
                                    <div class="mb-2">
                                        <img src="../assets/img/artikel/<?= $content['gambar'] ?>" width="200"
                                            class="img-thumbnail">
                                    </div>
                                <?php endif; ?>
                                <input type="file" class="form-control" name="gambar">
                                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar</small>
                            </div>
                        </div>

                        <div id="videoFields"
                            style="display: <?= $content['tipe_konten'] == 'video' ? 'block' : 'none' ?>">
                            <div class="form-group">
                                <label>URL Video</label>
                                <input type="url" class="form-control" name="video_link"
                                    value="<?= htmlspecialchars($content['video_link']) ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="form-control" name="deskripsi"
                                rows="3"><?= htmlspecialchars($content['deskripsi']) ?></textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="?page=dashboard" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    document.getElementById('tipeKonten').addEventListener('change', function () {
        const artikelFields = document.getElementById('artikelFields');
        const videoFields = document.getElementById('videoFields');

        if (this.value === 'artikel') {
            artikelFields.style.display = 'block';
            videoFields.style.display = 'none';
        } else {
            artikelFields.style.display = 'none';
            videoFields.style.display = 'block';
        }
    });

    // Trigger change event on page load to set initial visibility
    document.getElementById('tipeKonten').dispatchEvent(new Event('change'));
</script>