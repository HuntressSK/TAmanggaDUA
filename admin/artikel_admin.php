<?php 
// Definisikan judul halaman
$page_title = 'Manajemen Artikel';

// Panggil header layout
include 'admin_header.php'; 

// Panggil koneksi database
require_once '../db_connection.php';

// Query untuk mengambil semua data artikel
$sql = "SELECT id, judul, waktu_rilis FROM artikel ORDER BY waktu_rilis DESC";
$result = mysqli_query($conn, $sql);
?>

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Manajemen Artikel</h1>
    <a href="tambah_artikel.php" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
        + Tulis Artikel Baru
    </a>
</div>

<div class="bg-white shadow-md rounded-lg overflow-x-auto">
    <table class="min-w-full bg-white">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="w-1/12 text-left py-3 px-4 uppercase font-semibold text-sm">ID</th>
                <th class="w-6/12 text-left py-3 px-4 uppercase font-semibold text-sm">Judul Artikel</th>
                <th class="w-3/12 text-left py-3 px-4 uppercase font-semibold text-sm">Waktu Rilis</th>
                <th class="w-2/12 text-center py-3 px-4 uppercase font-semibold text-sm">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-4"><?php echo $row['id']; ?></td>
                        <td class="py-3 px-4 font-semibold"><?php echo htmlspecialchars($row['judul']); ?></td>
                        <td class="py-3 px-4"><?php echo date('d M Y, H:i', strtotime($row['waktu_rilis'])); ?></td>
                        <td class="py-3 px-4 text-center">
                            <a href="edit_artikel.php?id=<?php echo $row['id']; ?>" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded text-sm">
                                Edit
                            </a>
                            <a href="delete_artikel.php?id=<?php echo $row['id']; ?>" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
                                Hapus
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center py-5">Belum ada artikel. Silakan tulis artikel baru.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php 
// Panggil footer
include 'admin_footer.php'; 
?>