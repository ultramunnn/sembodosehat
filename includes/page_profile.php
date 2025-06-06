<?php

// Debug session
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Cek session dengan lebih detail
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {

    header("Location: ../login.php");
    exit;
}

include_once __DIR__ . '/../config/functions_profil.php';
include_once __DIR__ . '/../config/koneksi.php';

$edit = isset($_GET['edit']) ? true : false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (prosesUpdateProfil($conn, $_POST, $_FILES)) {
        echo "<script>alert('Profil berhasil disimpan!');</script>";
    } else {
        echo "<script>alert('Gagal menyimpan profil!');</script>";
    }
}

// Ambil data user
$user = getUserProfile($conn, $_SESSION['email']);
$riwayat_penyakit_options = getRiwayatPenyakit($conn);
$jenis_kelamin_options = getJenisKelamin($conn);
?>

<?php if ($edit): ?>
<div class="max-w-4xl mx-auto mt-14 bg-white p-10 rounded-lg shadow">
    <form class="grid grid-cols-2 gap-6" method="POST" enctype="multipart/form-data">
        <!-- Foto Profil -->
        <div class="col-span-2 flex items-center mb-6">
            <div class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden mr-4">
                <?php if (!empty($user['foto_user'])): ?>
                    <img src="../<?= htmlspecialchars($user['foto_user']) ?>" alt="Foto Profil" class="object-cover w-full h-full">
                <?php else: ?>
                    <span class="text-gray-400 text-4xl">👤</span>
                <?php endif; ?>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Foto Profil</label>
                <input id="fotoProfil" name="fotoProfil" type="file" accept="image/*" class="block text-sm text-gray-500" />
            </div>
        </div>
        <!-- Nama Lengkap -->
        <div>
            <label for="namaLengkap" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
            <input id="namaLengkap" name="namaLengkap" type="text" placeholder="Nama Lengkap"
                value="<?= htmlspecialchars($user['nama_lengkap'] ?? '') ?>"
                class="w-full bg-white border-2 border-green-300 rounded-md h-12 px-3 text-gray-700 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-green-300" />
        </div>
        <!-- Alamat -->
        <div>
            <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
            <input id="alamat" name="alamat" type="text" placeholder="Alamat"
                value="<?= htmlspecialchars($user['alamat'] ?? '') ?>"
                class="w-full bg-white border-2 border-green-300 rounded-md h-12 px-3 text-gray-700 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-green-300" />
        </div>
        <!-- Jenis Kelamin -->
        <div>
            <label for="jenisKelamin" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
            <select id="jenisKelamin" name="jenisKelamin"
                class="w-full bg-white border-2 border-green-300 rounded-md h-12 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-300">
                <option value="" <?= empty($user['jenis_kelamin']) ? 'selected' : '' ?> disabled>Jenis Kelamin</option>
                <?php foreach ($jenis_kelamin_options as $jk): ?>
                    <option value="<?= htmlspecialchars($jk['jenis_kelamin']) ?>"
                        <?= (isset($user['jenis_kelamin']) && $user['jenis_kelamin'] == $jk['jenis_kelamin']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($jk['jenis_kelamin']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <!-- Usia -->
        <div>
            <label for="usia" class="block text-sm font-medium text-gray-700 mb-1">Usia</label>
            <input id="usia" name="usia" type="number" placeholder="Usia"
                value="<?= htmlspecialchars($user['usia'] ?? '') ?>"
                class="w-full bg-white border-2 border-green-300 rounded-md h-12 px-3 text-gray-700 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-green-300" />
        </div>
        <!-- Bio -->
        <div class="col-span-2">
            <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
            <textarea id="bio" name="bio" placeholder="Isi bio" rows="3"
                class="w-full bg-white border-2 border-green-300 rounded-md px-3 py-3 text-gray-700 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-green-300 resize-none"><?= htmlspecialchars($user['bio'] ?? '') ?></textarea>
        </div>
        <!-- Riwayat Penyakit -->
        <div class="col-span-2">
            <label for="riwayatPenyakit" class="block text-sm font-medium text-gray-700 mb-1">Riwayat Penyakit</label>
            <select id="riwayatPenyakit" name="riwayatPenyakit"
                class="w-full bg-white border-2 border-green-300 rounded-md h-12 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-300">
                <option value="">-- Pilih Penyakit --</option>
                <?php foreach ($riwayat_penyakit_options as $rp): ?>
                    <option value="<?= $rp['id'] ?>"
                        <?= $user['penyakit_id'] == $rp['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($rp['nama']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <!-- Tombol Simpan -->
        <div class="col-span-2 flex justify-end">
            <button type="submit"
                class="bg-green-800 hover:bg-green-900 text-white px-8 py-2 rounded-md font-medium transition-colors duration-200">
                Simpan
            </button>
        </div>
    </form>
</div>
<?php else: ?>
<!-- Tampilan Profil -->
<div class="max-w-4xl mx-auto mt-14 bg-white p-10 rounded-lg shadow flex flex-col items-center">
    <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden mb-4">
        <?php if (!empty($user['foto_user'])): ?>
            <img src="../<?= htmlspecialchars($user['foto_user']) ?>" alt="Foto Profil" class="object-cover w-full h-full">
        <?php else: ?>
            <span class="text-gray-400 text-5xl">👤</span>
        <?php endif; ?>
    </div>
    <h2 class="text-xl font-semibold"><?= htmlspecialchars($user['nama_lengkap'] ?? '') ?></h2>
    <p class="text-gray-500 mb-2"><?= htmlspecialchars($user['email']) ?></p>
    <div class="grid grid-cols-2 gap-x-10 w-full mb-4">
        <div>
            <div class="text-gray-400 text-sm mb-1">Alamat</div>
            <div><?= htmlspecialchars($user['alamat']) ?></div>
        </div>
        <div>
            <div class="text-gray-400 text-sm mb-1">Jenis Kelamin</div>
            <div><?= htmlspecialchars($user['jenis_kelamin']) ?></div>
        </div>
        <div>
            <div class="text-gray-400 text-sm mb-1">Usia</div>
            <div><?= htmlspecialchars($user['usia']) ?> Tahun</div>
        </div>
        <div>
            <div class="text-gray-400 text-sm mb-1">Riwayat Penyakit</div>
            <div>
                <?php
                $nama_penyakit = getNamaPenyakit($conn, $user['penyakit_id']);
                echo htmlspecialchars($nama_penyakit);
                ?>
            </div>
        </div>
    </div>
    <div class="w-full mb-4">
        <div class="text-gray-400 text-sm mb-1">Bio</div>
        <div class="bg-gray-100 rounded-md p-3 text-gray-700"><?= htmlspecialchars($user['bio']) ?></div>
    </div>
    <div class="w-full flex justify-end">
        <a href="profile.php?edit=1"
            class="bg-green-800 hover:bg-green-900 text-white px-6 py-2 rounded-md font-medium transition-colors duration-200">
            Edit
        </a>
    </div>
</div>
<?php endif; ?>

<script>
    function updateFileName(input) {
        const fileName = document.getElementById('fileName');
        if (input.files && input.files[0]) {
            fileName.textContent = input.files[0].name;
            fileName.classList.remove('text-gray-400');
            fileName.classList.add('text-gray-700');
        } else {
            fileName.textContent = 'Pilih Foto';
            fileName.classList.remove('text-gray-700');
            fileName.classList.add('text-gray-400');
        }
    }

    // Hapus handler JS submit form, karena sudah ditangani PHP
</script>
</body>

</html>