<?php 
$page_title = 'Edit Artikel';
include 'admin_header.php'; 
require_once '../db_connection.php';

if (!isset($_GET['id'])) {
    header("Location: artikel_admin.php");
    exit();
}

$id_artikel = $_GET['id'];

// Ambil data artikel yang akan diedit
$sql = "SELECT * FROM artikel WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_artikel);
$stmt->execute();
$result = $stmt->get_result();
$artikel = $result->fetch_assoc();

if (!$artikel) {
    header("Location: artikel_admin.php");
    exit();
}
?>

<h1 class="text-2xl font-bold mb-6 text-gray-800">Edit Artikel</h1>

<div class="bg-white shadow-md rounded-lg p-6">
    <form action="proses_edit_artikel.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $artikel['id']; ?>">
        
        <div class="mb-4">
            <label for="judul" class="block text-gray-700 font-semibold mb-2">Judul Utama Artikel</label>
            <input type="text" id="judul" name="judul" class="w-full px-4 py-2 border rounded-lg" value="<?php echo htmlspecialchars($artikel['judul']); ?>" required>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Gambar Utama (Header)</label>
            <img src="../assets/images/images/<?php echo htmlspecialchars($artikel['judul_gambar']); ?>" class="h-20 w-auto mb-2 border rounded">
            <input type="file" name="judul_gambar" class="w-full px-4 py-2 border rounded-lg">
            <input type="hidden" name="judul_gambar_lama" value="<?php echo htmlspecialchars($artikel['judul_gambar']); ?>">
        </div>
        
        <div class="mb-6">
            <label for="about" class="block text-gray-700 font-semibold mb-2">Teks Pengantar (About)</label>
            <textarea id="about" name="about" rows="4" class="w-full px-4 py-2 border rounded-lg" required><?php echo htmlspecialchars($artikel['about']); ?></textarea>
        </div>

        <hr class="my-8">

        <h2 class="text-xl font-bold mb-4 text-gray-800">Sub Bagian 1</h2>
        <div class="mb-4">
            <label for="subjudul1" class="block text-gray-700 font-semibold mb-2">Sub Judul 1</label>
            <input type="text" id="subjudul1" name="subjudul1" class="w-full px-4 py-2 border rounded-lg" value="<?php echo htmlspecialchars($artikel['subjudul1']); ?>">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Gambar 1</label>
            <?php if(!empty($artikel['gambar1'])): ?><img src="../assets/images/images/<?php echo htmlspecialchars($artikel['gambar1']); ?>" class="h-20 w-auto mb-2 border rounded"><?php endif; ?>
            <input type="file" name="gambar1" class="w-full px-4 py-2 border rounded-lg">
            <input type="hidden" name="gambar1_lama" value="<?php echo htmlspecialchars($artikel['gambar1']); ?>">
        </div>
        <div class="mb-6">
            <label for="teks1" class="block text-gray-700 font-semibold mb-2">Teks Paragraf 1</label>
            <textarea name="teks1" rows="4" class="w-full px-4 py-2 border rounded-lg"><?php echo htmlspecialchars($artikel['teks1']); ?></textarea>
        </div>
        
        <div class="mt-8">
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg">
                Update Artikel
            </button>
        </div>
    </form>
</div>

<?php 
include 'admin_footer.php'; 
?>