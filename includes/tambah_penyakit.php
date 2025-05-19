<?php include __DIR__ . '/app_admin.php'; ?>


<div class="content-wrapper">
    <div class="card card-primary m-5">
        <div class="card-header">
            <h3 class="card-title">Tambah Riwayat Penyakit</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            <div class="card-body">
                <div class="form-group">
                    <label for="penyakit">Penyakit</label>
                    <input type="text" class="form-control" id="penyakit" placeholder="Enter penyakit">
                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
<!-- /.card -->