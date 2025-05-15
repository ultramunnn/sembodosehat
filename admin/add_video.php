<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$pageTitle = 'Tambah Video';

$content = <<<HTML
<form method="POST" action="">
    <div class="mb-3">
        <label for="video_url" class="form-label fw-semibold">URL Video (YouTube)</label>
        <input type="url" id="video_url" name="video_url" class="form-control" placeholder="https://www.youtube.com/watch?v=xxxxxx" required autofocus>
        <div class="form-text">Masukkan URL video yang ingin ditampilkan.</div>
    </div>
    <button type="submit" class="btn btn-green px-4 py-2">Simpan Video</button>
</form>
HTML;

include __DIR__ . '/../includes/app_admin.php';
?>
