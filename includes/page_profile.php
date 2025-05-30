<div class="max-w-4xl mx-auto mt-14">
    <form class="space-y-6">
        <!-- Row 1: Nama Lengkap and Alamat -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2 ">
                <label for="namaLengkap" class="block text-black text-sm font-medium">
                    Nama Lengkap
                </label>
                <input id="namaLengkap" type="text" placeholder="Nama Lengkap"
                    class="w-full bg-white border-2 border-green-300 rounded-md h-12 px-3 text-gray-700 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-green-300" />
            </div>
            <div class="space-y-2">
                <label for="alamat" class="block text-black text-sm font-medium">
                    Alamat
                </label>
                <input id="alamat" type="text" placeholder="Alamat"
                    class="w-full bg-white border-2  border-green-300 rounded-md h-12 px-3 text-gray-700 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-green-300" />
            </div>
        </div>

        <!-- Row 2: Jenis Kelamin and Usia -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label for="jenisKelamin" class="block text-black text-sm font-medium">
                    Jenis Kelamin
                </label>
                <select id="jenisKelamin"
                    class="w-full bg-white border-2  border-green-300 rounded-md h-12 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-300 appearance-none bg-no-repeat bg-right pr-10"
                    style="background-image: url('data:image/svg+xml;charset=US-ASCII,<svg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 4 5\'><path fill=\'%23666\' d=\'M2 0L0 2h4zm0 5L0 3h4z\'/></svg>'); background-position: right 12px center; background-size: 12px;">
                    <option value="" disabled selected>Jenis Kelamin</option>
                    <option value="laki-laki">Laki-laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>
            </div>
            <div class="space-y-2">
                <label for="usia" class="block text-black text-sm font-medium">
                    Usia
                </label>
                <input id="usia" type="number" placeholder="Usia"
                    class="w-full bg-white border-2  border-green-300 rounded-md h-12 px-3 text-gray-700 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-green-300" />
            </div>
        </div>

        <!-- Row 3: Bio and Riwayat Penyakit -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label for="bio" class="block text-black text-sm font-medium">
                    Bio
                </label>
                <textarea id="bio" placeholder="Isi bio" rows="3"
                    class="w-full bg-white border-2  border-green-300 rounded-md px-3 py-3 text-gray-700 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-green-300 resize-none"></textarea>
            </div>
            <div class="space-y-2">
                <label for="riwayatPenyakit" class="block text-black text-sm font-medium">
                    Riwayat Penyakit
                </label>
                <select id="riwayatPenyakit"
                    class="w-full bg-white border-2  border-green-300 rounded-md h-12 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-300 appearance-none bg-no-repeat bg-right pr-10"
                    style="background-image: url('data:image/svg+xml;charset=US-ASCII,<svg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 4 5\'><path fill=\'%23666\' d=\'M2 0L0 2h4zm0 5L0 3h4z\'/></svg>'); background-position: right 12px center; background-size: 12px;">
                    <option value="" disabled selected>Riwayat Penyakit</option>
                    <option value="tidak-ada">Tidak Ada</option>
                    <option value="diabetes">Diabetes</option>
                    <option value="hipertensi">Hipertensi</option>
                    <option value="jantung">Penyakit Jantung</option>
                    <option value="lainnya">Lainnya</option>
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
                    <input id="fotoProfil" type="file" accept="image/*"
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

    // Form submission handler
    document.querySelector('form').addEventListener('submit', function (e) {
        e.preventDefault();

        // Get form data
        const formData = new FormData(this);
        const data = {};

        // Convert FormData to object
        for (let [key, value] of formData.entries()) {
            data[key] = value;
        }

        console.log('Form Data:', data);
        alert('Form berhasil dikirim! Lihat console untuk detail.');
    });
</script>
</body>

</html>