<?php
include __DIR__ . '/../config/functions_tambahartikel.php';

$kontens = [];
if (isset($_GET['penyakit'])) {
    $penyakit_id = $_GET['penyakit'];
    $sql = "
    SELECT k.*
    FROM konten k
    JOIN konten_penyakit kp ON k.id = kp.konten_id
    WHERE kp.penyakit_id = $penyakit_id 
    AND k.tipe_konten IN ('artikel','video')
    ORDER BY k.id ASC
";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $kontens = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
$artikels = tampilkan_artikel($conn);



?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Riwayat Penyakit</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="" method="GET">
                                <div class="form-group">
                                    <label>Penyakit</label>
                                    <select class="form-control select2bs4" style="width: 100%;" name="penyakit"
                                        onchange="this.form.submit()">
                                        <option value="">-- Pilih Penyakit --</option>
                                        <?php
                                        $result = mysqli_query($conn, "SELECT * FROM riwayat_penyakit ORDER BY nama");
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $selected = ($_GET['penyakit'] ?? '') == $row['id'] ? 'selected' : '';
                                            echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $row['nama'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </form>

                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Konten</h3>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 4px">No</th>
                                        <th style="width: 100px">Judul</th>
                                        <th style="width: 50px">Deskripsi</th>
                                        <th style="width: 50px">Gambar</th>
                                        <th style="width: 150px">Isi Artikel/Link</th> <!-- Tambah kolom ini -->
                                        <th style="width: 40px">Jenis</th>
                                        <th style="width: 40px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><?php if ($kontens === []): ?>
                                            <td colspan="7" class="text-center">Tidak ada konten untuk penyakit ini</td>

                                        <?php endif; ?>
                                    </tr>

                                    <?php foreach ($kontens as $i => $k): ?>
                                        <tr>
                                            <td><?= $i + 1 ?></td>
                                            <td><?= $k['judul'] ?></td>
                                            <td><?= $k['deskripsi'] ?></td>
                                            <td>
                                                <?php if ($k['gambar']): ?>
                                                    <img src="../assets/img/artikel/<?= $k['gambar'] ?>" width="80">
                                                <?php else: ?>
                                                    <em class="font-weight-bold">-</em>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php if ($k['isi_artikel']):
                                                echo $k['isi_artikel'];
                                            else:
                                                echo $k['video_link'];
                                            endif; ?></td>


                                            </td>
                                            <!-- Tampilkan isi artikel -->
                                            <td><?= $k['tipe_konten'] ?></td>
                                            <td>

                                                <a href="?page=edit_konten&id=<?= $k['id'] ?>"
                                                    class="btn btn-sm btn-warning">Edit</a>
                                                <a href="?page=delete_konten&id=<?= $k['id'] ?>"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Yakin ingin menghapus konten ini?');">Delete</a>
                                            </td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                                <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.card -->
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </div>
        <!-- /.card -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>