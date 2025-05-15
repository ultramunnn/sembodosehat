<?php
$pageTitle = "Tambah Artikel";

$content = <<<HTML
<form method="POST" action="">
  <div class="mb-3">
    <label for="title" class="form-label fw-semibold">Judul Artikel</label>
    <input type="text" id="title" name="title" class="form-control" placeholder="Masukkan judul artikel" required autofocus>
  </div>
  <div class="mb-4">
    <label for="content" class="form-label fw-semibold">Isi Artikel</label>
    <textarea id="content" name="content" class="form-control" rows="8" placeholder="Tulis isi artikel di sini..." required></textarea>
  </div>
  <button type="submit" class="btn btn-green px-4 py-2">Simpan Artikel</button>
</form>
HTML;

include __DIR__ . '/../includes/app_admin.php';
