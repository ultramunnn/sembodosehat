<?php
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');

    if ($title === '' || $content === '') {
        $message = '<div class="alert alert-danger">Judul dan isi artikel wajib diisi!</div>';
    } else {
        // Simpan ke database (TODO)
        $message = '<div class="alert alert-success">Artikel berhasil disimpan!</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tambah Artikel - Admin SembodoSehat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #e8f5e9;
        }

        .navbar-green {
            background-color: #388e3c;
        }

        .btn-green {
            background-color: #2e7d32;
            color: white;
        }

        .btn-green:hover {
            background-color: #1b5e20;
            color: white;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-green navbar-dark mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="dashboard.php">SembodoSehat Admin</a>
        </div>
    </nav>

    <div class="container">
        <h1 class="mb-4 text-success">Tambah Artikel Baru</h1>

        <?= $message ?>

        <form method="POST" action="">
            <div class="mb-3">
                <label for="title" class="form-label fw-semibold">Judul Artikel</label>
                <input type="text" id="title" name="title" class="form-control" placeholder="Masukkan judul artikel"
                    required autofocus>
            </div>
            <div class="mb-4">
                <label for="content" class="form-label fw-semibold">Isi Artikel</label>
                <textarea id="content" name="content" class="form-control" rows="8"
                    placeholder="Tulis isi artikel di sini..." required></textarea>
            </div>
            <button type="submit" class="btn btn-green px-4 py-2">Simpan Artikel</button>
            <a href="dashboard.php" class="btn btn-outline-success ms-3">Kembali</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>