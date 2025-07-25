<?php 
$page_title = 'Tulis Artikel Baru';
include 'admin_header.php'; 
?>

<h1 class="text-2xl font-bold mb-6 text-gray-800">Tulis Artikel Baru</h1>

<div class="bg-white shadow-md rounded-lg p-6">
    <form action="proses_tambah_artikel.php" method="POST" enctype="multipart/form-data">
        
        <div class="mb-4">
            <label for="judul" class="block text-gray-700 font-semibold mb-2">Judul Utama Artikel</label>
            <input type="text" id="judul" name="judul" class="w-full px-4 py-2 border rounded-lg" required>
        </div>
        
        <div class="mb-4">
            <label for="judul_gambar" class="block text-gray-700 font-semibold mb-2">Gambar Utama (Header)</label>
            <input type="file" id="judul_gambar" name="judul_gambar" class="w-full px-4 py-2 border rounded-lg" required>
        </div>
        
        <div class="mb-6">
            <label for="about" class="block text-gray-700 font-semibold mb-2">Teks Pengantar (About)</label>
            <textarea id="about" name="about" rows="4" class="w-full px-4 py-2 border rounded-lg" required></textarea>
        </div>

        <hr class="my-8">

        <h2 class="text-xl font-bold mb-4 text-gray-800">Sub Bagian 1</h2>
        <div class="mb-4">
            <label for="subjudul1" class="block text-gray-700 font-semibold mb-2">Sub Judul 1</label>
            <input type="text" id="subjudul1" name="subjudul1" class="w-full px-4 py-2 border rounded-lg">
        </div>
        <div class="mb-4">
            <label for="gambar1" class="block text-gray-700 font-semibold mb-2">Gambar 1</label>
            <input type="file" id="gambar1" name="gambar1" class="w-full px-4 py-2 border rounded-lg">
        </div>
        <div class="mb-6">
            <label for="teks1" class="block text-gray-700 font-semibold mb-2">Teks Paragraf 1</label>
            <textarea id="teks1" name="teks1" rows="4" class="w-full px-4 py-2 border rounded-lg"></textarea>
        </div>

        <hr class="my-8">

        <h2 class="text-xl font-bold mb-4 text-gray-800">Sub Bagian 2</h2>
         <div class="mb-4">
            <label for="subjudul2" class="block text-gray-700 font-semibold mb-2">Sub Judul 2</label>
            <input type="text" id="subjudul2" name="subjudul2" class="w-full px-4 py-2 border rounded-lg">
        </div>
        <div class="mb-4">
            <label for="gambar2" class="block text-gray-700 font-semibold mb-2">Gambar 2</label>
            <input type="file" id="gambar2" name="gambar2" class="w-full px-4 py-2 border rounded-lg">
        </div>
        <div class="mb-6">
            <label for="teks2" class="block text-gray-700 font-semibold mb-2">Teks Paragraf 2</label>
            <textarea id="teks2" name="teks2" rows="4" class="w-full px-4 py-2 border rounded-lg"></textarea>
        </div>
        
        <div class="mt-8">
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg">
                Publikasikan Artikel
            </button>
        </div>
    </form>
</div>
<?php 
include 'admin_footer.php'; 
?>