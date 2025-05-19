<?php include __DIR__ . '/app_admin.php'; ?>


<div class="content-wrapper">
    <div class="card card-primary m-5">
        <div class="card-header">
            <h3 class="card-title">Tambah Video</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            <div class="card-body">
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" class="form-control" id="judul" placeholder="Enter judul">
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" placeholder="Enter deskripsi" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label for="link">Link Video</label>
                    <input type="text" class="form-control" id="link" placeholder="Enter link">
                </div>

                <div class="form-group">
                    <label>Penyakit</label>
                    <select class="form-control select2bs4" style="width: 100%;">
                        <option>Pusing</option>
                        <option>Maag</option>
                        <option>Jantung</option>

                    </select>
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