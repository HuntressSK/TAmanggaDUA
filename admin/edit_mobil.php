<?php
$page_title = 'Edit Mobil';
include 'admin_header.php';
require_once '../db_connection.php';

// Pastikan ada ID mobil yang dikirim
if (!isset($_GET['id'])) {
    header("Location: dashboard_product.php");
    exit();
}

$id_mobil = $_GET['id'];

// Ambil data mobil yang akan diedit
$sql = "SELECT * FROM mobil WHERE id_mobil = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_mobil);
$stmt->execute();
$result = $stmt->get_result();
$mobil = $result->fetch_assoc();

if (!$mobil) {
    header("Location: dashboard_product.php");
    exit();
}
?>

<h1 class="text-2xl font-bold mb-6 text-gray-800">Edit Mobil: <?php echo htmlspecialchars($mobil['nama_mobil']); ?></h1>

<div class="bg-white shadow-md rounded-lg p-6">
    <form action="proses_edit_mobil.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_mobil" value="<?php echo $mobil['id_mobil']; ?>">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <div class="mb-4">
                  <label for="nama_mobil" class="block text-gray-700 font-semibold mb-2">Nama Mobil</label>
                  <input type="text" id="nama_mobil" name="nama_mobil" class="w-full px-4 py-2 border rounded-lg" value="<?php echo htmlspecialchars($mobil['nama_mobil']); ?>" required>
              </div>
              <div class="mb-4">
                  <label for="harga_mobil" class="block text-gray-700 font-semibold mb-2">Harga Sewa / Hari (Rp)</label>
                  <input type="number" id="harga_mobil" name="harga_mobil" class="w-full px-4 py-2 border rounded-lg" value="<?php echo htmlspecialchars($mobil['harga_mobil']); ?>" required>
              </div>
              <div class="mb-4">
                  <label for="supir" class="block text-gray-700 font-semibold mb-2">Biaya Supir / Hari (Rp)</label>
                  <input type="number" id="supir" name="supir" class="w-full px-4 py-2 border rounded-lg" value="<?php echo htmlspecialchars($mobil['supir']); ?>" required>
              </div>
              <div class="mb-4">
                  <label for="deskripsi_p1" class="block text-gray-700 font-semibold mb-2">Deskripsi Paragraf 1</label>
                  <textarea id="deskripsi_p1" name="deskripsi_p1" rows="3" class="w-full px-4 py-2 border rounded-lg" required><?php echo htmlspecialchars($mobil['deskripsi_p1']); ?></textarea>
              </div>
              <div class="mb-4">
                  <label for="deskripsi_p2" class="block text-gray-700 font-semibold mb-2">Deskripsi Paragraf 2</label>
                  <textarea id="deskripsi_p2" name="deskripsi_p2" rows="3" class="w-full px-4 py-2 border rounded-lg" required><?php echo htmlspecialchars($mobil['deskripsi_p2']); ?></textarea>
              </div>
              <div class="mb-4">
                  <label for="deskripsi_p3" class="block text-gray-700 font-semibold mb-2">Deskripsi Paragraf 3</label>
                  <textarea id="deskripsi_p3" name="deskripsi_p3" rows="3" class="w-full px-4 py-2 border rounded-lg" required><?php echo htmlspecialchars($mobil['deskripsi_p3']); ?></textarea>
              </div>
              <div class="mb-4">
                  <label for="deskripsi_p4" class="block text-gray-700 font-semibold mb-2">Deskripsi Paragraf 4 (Opsional)</label>
                  <textarea id="deskripsi_p4" name="deskripsi_p4" rows="3" class="w-full px-4 py-2 border rounded-lg"><?php echo htmlspecialchars($mobil['deskripsi_p4']); ?></textarea>
              </div>
        </div>
        <div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Gambar 1 (Utama)</label>
                <img src="../assets/images/images//<?php echo htmlspecialchars($mobil['gambar1']); ?>" class="h-20 w-auto mb-2 border rounded">
                <input type="file" name="gambar1" class="w-full px-4 py-2 border rounded-lg">
                <input type="hidden" name="gambar1_lama" value="<?php echo htmlspecialchars($mobil['gambar1']); ?>">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Gambar 2</label>
                <img src="../assets/images/images//<?php echo htmlspecialchars($mobil['gambar2']); ?>" class="h-20 w-auto mb-2 border rounded">
                <input type="file" name="gambar2" class="w-full px-4 py-2 border rounded-lg">
                <input type="hidden" name="gambar2_lama" value="<?php echo htmlspecialchars($mobil['gambar2']); ?>">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Gambar 3</label>
                <img src="../assets/images/images//<?php echo htmlspecialchars($mobil['gambar3']); ?>" class="h-20 w-auto mb-2 border rounded">
                <input type="file" name="gambar3" class="w-full px-4 py-2 border rounded-lg">
                <input type="hidden" name="gambar3_lama" value="<?php echo htmlspecialchars($mobil['gambar3']); ?>">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Gambar 4</label>
                <img src="../assets/images/images//<?php echo htmlspecialchars($mobil['gambar4']); ?>" class="h-20 w-auto mb-2 border rounded">
                <input type="file" name="gambar4" class="w-full px-4 py-2 border rounded-lg">
                <input type="hidden" name="gambar4_lama" value="<?php echo htmlspecialchars($mobil['gambar4']); ?>">
            </div>
        </div>
        <div class="mt-6">
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg">
                Update Mobil
            </button>
        </div>
    </form>
</div>
<?php 
include 'admin_footer.php'; 
?>