<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$pageTitle = "Dashboard Admin";

$content = <<<HTML
<div class="accordion" id="penyakitAccordion">

  <!-- Contoh riwayat penyakit 1 -->
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
        Diabetes Melitus
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#penyakitAccordion">
      <div class="accordion-body">
      

        <h5>Artikel Terkait</h5>
        <table class="table table-bordered table-striped">
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
                <button class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil-square"></i> Edit</button>
                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i> Delete</button>
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
              <td><a href="https://youtu.be/example1" target="_blank" rel="noopener noreferrer">youtu.be/example1</a></td>
              <td>2025-05-11</td>
              <td>
                <button class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil-square"></i> Edit</button>
                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i> Delete</button>
              </td>
            </tr>
          </tbody>
        </table>

      </div>
    </div>
  </div>

  <!-- Contoh riwayat penyakit 2 -->
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        Hipertensi
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#penyakitAccordion">
      <div class="accordion-body">
       

        <h5>Artikel Terkait</h5>
        <table class="table table-bordered table-striped">
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
                <button class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil-square"></i> Edit</button>
                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i> Delete</button>
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
              <td><a href="https://youtu.be/example2" target="_blank" rel="noopener noreferrer">youtu.be/example2</a></td>
              <td>2025-05-12</td>
              <td>
                <button class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil-square"></i> Edit</button>
                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i> Delete</button>
              </td>
            </tr>
          </tbody>
        </table>

      </div>
    </div>
  </div>

</div>
HTML;

include __DIR__ . '/../includes/app_admin.php';
