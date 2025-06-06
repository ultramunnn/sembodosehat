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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (prosesUpdateProfil($conn, $_POST, $_FILES)) {
        echo "<script>alert('Profil berhasil disimpan!');</script>";
    } else {
        echo "<script>alert('Gagal menyimpan profil!');</script>";
    }
}

// Ganti kode query dengan fungsi
$riwayat_penyakit_options = getRiwayatPenyakit($conn);
$jenis_kelamin_options = getJenisKelamin($conn);
?>

<!-- ...existing code... -->
<div class="max-w-4xl mx-auto mt-14">
    <form class="space-y-6" method="POST" enctype="multipart/form-data">
        <!-- Row 1: Nama Lengkap and Alamat -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2 ">
                <label for="namaLengkap" class="block text-black text-sm font-medium">
                    Nama Lengkap
                </label>
                <input id="namaLengkap" name="namaLengkap" type="text" placeholder="Nama Lengkap"
                    class="w-full bg-white border-2 border-green-300 rounded-md h-12 px-3 text-gray-700 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-green-300" />
            </div>
            <div class="space-y-2">
                <label for="alamat" class="block text-black text-sm font-medium">
                    Alamat
                </label>
                <input id="alamat" name="alamat" type="text" placeholder="Alamat"
                    class="w-full bg-white border-2  border-green-300 rounded-md h-12 px-3 text-gray-700 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-green-300" />
            </div>
        </div>

        <!-- Row 2: Jenis Kelamin and Usia -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label for="jenisKelamin" class="block text-black text-sm font-medium">
                    Jenis Kelamin
                </label>
                <select id="jenisKelamin" name="jenisKelamin"
                    class="w-full bg-white border-2  border-green-300 rounded-md h-12 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-300 appearance-none bg-no-repeat bg-right pr-10"
                    style="background-image: url('data:image/svg+xml;charset=US-ASCII,<svg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 4 5\'><path fill=\'%23666\' d=\'M2 0L0 2h4zm0 5L0 3h4z\'/></svg>'); background-position: right 12px center; background-size: 12px;">
                    <option value="" disabled selected>Jenis Kelamin</option>
                    <?php foreach ($jenis_kelamin_options as $jk): ?>
                        <option value="<?= htmlspecialchars($jk['jenis_kelamin']) ?>">
                            <?= htmlspecialchars($jk['jenis_kelamin']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="space-y-2">
                <label for="usia" class="block text-black text-sm font-medium">
                    Usia
                </label>
                <input id="usia" name="usia" type="number" placeholder="Usia"
                    class="w-full bg-white border-2  border-green-300 rounded-md h-12 px-3 text-gray-700 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-green-300" />
            </div>
        </div>

        <!-- Row 3: Bio and Riwayat Penyakit -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label for="bio" class="block text-black text-sm font-medium">
                    Bio
                </label>
                <textarea id="bio" name="bio" placeholder="Isi bio" rows="3"
                    class="w-full bg-white border-2  border-green-300 rounded-md px-3 py-3 text-gray-700 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-green-300 resize-none"></textarea>
            </div>
            <div class="space-y-2">
                <label for="riwayatPenyakit" class="block text-black text-sm font-medium">
                    Riwayat Penyakit
                </label>
                <select id="riwayatPenyakit" name="riwayatPenyakit"
                    class="w-full bg-white border-2  border-green-300 rounded-md h-12 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-300 appearance-none bg-no-repeat bg-right pr-10"
                    style="background-image: url('data:image/svg+xml;charset=US-ASCII,<svg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 4 5\'><path fill=\'%23666\' d=\'M2 0L0 2h4zm0 5L0 3h4z\'/></svg>'); background-position: right 12px center; background-size: 12px;">
                    <option value="" disabled selected>Riwayat Penyakit</option>
                    <option value="">-- Pilih Penyakit --</option>
                    <?php foreach ($riwayat_penyakit_options as $rp): ?>
                        <option value="<?= htmlspecialchars($rp['id']) ?>"><?= htmlspecialchars($rp['nama']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <!-- Row 4: Foto Profil -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label for="fotoProfil" class="block text-black text-sm font-medium">
                    Foto Profil
                </label>
                <div class="relative">
                    <input id="fotoProfil" name="fotoProfil" type="file" accept="image/*"
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                        onchange="updateFileName(this)" />
                    <div
                        class="bg-white border-2  border-green-300 rounded-md h-12 flex items-center justify-between px-3 cursor-pointer">
                        <span id="fileName" class="text-gray-400 text-sm">Pilih Foto</span>
                        <button type="button"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-700 text-xs px-3 py-1 h-8 rounded">
                            Pilih Foto
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end pt-6">
            <button type="submit"
                class="bg-green-800 hover:bg-green-900 text-white px-8 py-2 rounded-md font-medium transition-colors duration-200">
                Simpan
            </button>
        </div>
    </form>
</div>

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