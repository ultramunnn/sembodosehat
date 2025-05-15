<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Admin - SembodoSehat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <style>
        body {
            background-color: #e8f5e9;
        }

        .btn-green {
            background-color: #2e7d32;
            color: white;
        }

        .btn-green:hover {
            background-color: #1b5e20;
            color: white;
        }

        .navbar-green {
            background-color: #388e3c;
        }

        /* Sidebar styles */
        .sidebar {
            height: 100vh;
            background-color: #2e7d32;
            padding-top: 1rem;
            position: fixed;
            width: 220px;
        }

        .sidebar a {
            color: white;
            display: block;
            padding: 0.75rem 1.25rem;
            text-decoration: none;
            font-weight: 600;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #1b5e20;
            color: white;
            text-decoration: none;
        }

        /* Content area */
        .content {
            margin-left: 220px;
            padding: 2rem;
        }

        @media (max-width: 767.98px) {

            /* Sidebar jadi horizontal atas di mobile */
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
                display: flex;
                padding: 0;
            }

            .sidebar a {
                flex: 1;
                text-align: center;
                padding: 1rem 0;
                border-right: 1px solid rgba(255, 255, 255, 0.2);
            }

            .sidebar a:last-child {
                border-right: none;
            }

            .content {
                margin-left: 0;
                padding: 1rem;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-green navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">SembodoSehat Admin</a>
        </div>
    </nav>

    <div class="d-flex">
        <!-- Sidebar -->
        <aside class="sidebar">
            <a href="#" class="active"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
            <a href="add_article.php"><i class="bi bi-journal-text me-2"></i> Tambah Artikel</a>
            <a href="add_video.php"><i class="bi bi-camera-video me-2"></i> Tambah Video</a>
            <a href="add_penyakit.php"><i class="bi bi-people me-2"></i> Riwayat Penyakit</a>
            <!-- Tambah menu lain jika perlu -->
            <a href="#"><i class="bi bi-box-arrow-right me-2"></i> Logout</a>
        </aside>

        <!-- Konten utama -->
        <main class="content flex-grow-1">
            <h1 class="mb-4 text-success">Dashboard Admin</h1>

            <!-- Accordion Riwayat Penyakit -->
            <div class="accordion" id="penyakitAccordion">

                <!-- Penyakit 1 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Diabetes Melitus
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                        data-bs-parent="#penyakitAccordion">
                        <div class="accordion-body">

                            <h5>Artikel Terkait</h5>
                            <table class="table table-bordered table-striped mb-4">
                                <thead class="table-success">
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Artikel</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Manfaat Pola Hidup Sehat untuk Diabetes</td>
                                        <td>2025-05-10</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary me-1"><i
                                                    class="bi bi-view-list"></i> Lihat</button>
                                            <button class="btn btn-sm btn-outline-primary me-1"><i
                                                    class="bi bi-pencil-square"></i> Edit</button>
                                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i>
                                                Hapus</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <h5>Video Terkait</h5>
                            <table class="table table-bordered table-striped">
                                <thead class="table-success">
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Video</th>
                                        <th>URL</th>
                                        <th>Tanggal Ditambahkan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Senam untuk Penderita Diabetes</td>
                                        <td><a href="https://youtu.be/example1" target="_blank"
                                                rel="noopener noreferrer">youtu.be/example1</a></td>
                                        <td>2025-05-11</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary me-1"><i
                                                    class="bi bi-view-list"></i> Lihat</button>
                                            <button class="btn btn-sm btn-outline-primary me-1"><i
                                                    class="bi bi-pencil-square"></i> Edit</button>
                                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i>
                                                Hapus</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Penyakit 2 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Hipertensi
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                        data-bs-parent="#penyakitAccordion">
                        <div class="accordion-body">

                            <h5>Artikel Terkait</h5>
                            <table class="table table-bordered table-striped mb-4">
                                <thead class="table-success">
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Artikel</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Cara Mengontrol Hipertensi</td>
                                        <td>2025-05-09</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary me-1"><i
                                                    class="bi bi-view-list"></i> Lihat</button>
                                            <button class="btn btn-sm btn-outline-primary me-1"><i
                                                    class="bi bi-pencil-square"></i> Edit</button>
                                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i>
                                                Hapus</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <h5>Video Terkait</h5>
                            <table class="table table-bordered table-striped">
                                <thead class="table-success">
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Video</th>
                                        <th>URL</th>
                                        <th>Tanggal Ditambahkan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Tips Diet untuk Hipertensi</td>
                                        <td><a href="https://youtu.be/example2" target="_blank"
                                                rel="noopener noreferrer">youtu.be/example2</a></td>
                                        <td>2025-05-12</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary me-1"><i
                                                    class="bi bi-view-list"></i> Lihat</button>
                                            <button class="btn btn-sm btn-outline-primary me-1"><i
                                                    class="bi bi-pencil-square"></i> Edit</button>
                                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i>
                                                Hapus</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>