<?php 
$page_title = 'Tambah Mobil Baru';
include 'admin_header.php'; 
?>

<h1 class="text-2xl font-bold mb-6 text-gray-800">Tambah Mobil Baru</h1>

<div class="bg-white shadow-md rounded-lg p-6">
    <form action="proses_tambah_mobil.php" method="POST" enctype="multipart/form-data">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <div class="mb-4">
                    <label for="nama_mobil" class="block text-gray-700 font-semibold mb-2">Nama Mobil</label>
                    <input type="text" id="nama_mobil" name="nama_mobil" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="harga_mobil" class="block text-gray-700 font-semibold mb-2">Harga Sewa / Hari (Rp)</label>
                    <input type="number" id="harga_mobil" name="harga_mobil" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="supir" class="block text-gray-700 font-semibold mb-2">Biaya Supir / Hari (Rp)</label>
                    <input type="number" id="supir" name="supir" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="deskripsi_p1" class="block text-gray-700 font-semibold mb-2">Deskripsi Paragraf 1</label>
                    <textarea id="deskripsi_p1" name="deskripsi_p1" rows="3" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                </div>
                 <div class="mb-4">
                    <label for="deskripsi_p2" class="block text-gray-700 font-semibold mb-2">Deskripsi Paragraf 2</label>
                    <textarea id="deskripsi_p2" name="deskripsi_p2" rows="3" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                </div>
                 <div class="mb-4">
                    <label for="deskripsi_p3" class="block text-gray-700 font-semibold mb-2">Deskripsi Paragraf 3</label>
                    <textarea id="deskripsi_p3" name="deskripsi_p3" rows="3" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                </div>
                 <div class="mb-4">
                    <label for="deskripsi_p4" class="block text-gray-700 font-semibold mb-2">Deskripsi Paragraf 4 (Opsional)</label>
                    <textarea id="deskripsi_p4" name="deskripsi_p4" rows="3" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>
            </div>
            <div>
                <div class="mb-4">
                    <label for="gambar1" class="block text-gray-700 font-semibold mb-2">Gambar 1 (Utama)</label>
                    <input type="file" id="gambar1" name="gambar1" class="w-full px-4 py-2 border rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label for="gambar2" class="block text-gray-700 font-semibold mb-2">Gambar 2</label>
                    <input type="file" id="gambar2" name="gambar2" class="w-full px-4 py-2 border rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label for="gambar3" class="block text-gray-700 font-semibold mb-2">Gambar 3</label>
                    <input type="file" id="gambar3" name="gambar3" class="w-full px-4 py-2 border rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label for="gambar4" class="block text-gray-700 font-semibold mb-2">Gambar 4</label>
                    <input type="file" id="gambar4" name="gambar4" class="w-full px-4 py-2 border rounded-lg" required>
                </div>
            </div>
        </div>
        <div class="mt-6">
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg">
                Simpan Mobil
            </button>
        </div>
    </form>
</div>
<?php 
include 'admin_footer.php'; 
?>