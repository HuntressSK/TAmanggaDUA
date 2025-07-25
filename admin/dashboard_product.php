<?php 
// Definisikan judul halaman
$page_title = 'Manajemen Produk';

// Panggil header layout
include 'admin_header.php'; 

// Panggil koneksi database
require_once '../db_connection.php';

// Query untuk mengambil semua data mobil
$sql = "SELECT id_mobil, nama_mobil, harga_mobil, gambar1 FROM mobil ORDER BY id_mobil DESC";
$result = mysqli_query($conn, $sql);
?>

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Manajemen Produk Mobil</h1>
    <a href="tambah_mobil.php" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
        + Tambah Mobil Baru
    </a>
</div>

<div class="bg-white shadow-md rounded-lg overflow-x-auto">
    <table class="min-w-full bg-white">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="w-1/12 text-left py-3 px-4 uppercase font-semibold text-sm">ID</th>
                <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">Gambar</th>
                <th class="w-4/12 text-left py-3 px-4 uppercase font-semibold text-sm">Nama Mobil</th>
                <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">Harga/Hari</th>
                <th class="w-3/12 text-center py-3 px-4 uppercase font-semibold text-sm">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-4"><?php echo $row['id_mobil']; ?></td>
                        <td class="py-3 px-4">
                            <img src="../assets/images/images//<?php echo htmlspecialchars($row['gambar1']); ?>" alt="<?php echo htmlspecialchars($row['nama_mobil']); ?>" class="h-16 w-24 object-cover rounded-md">
                        </td>
                        <td class="py-3 px-4 font-semibold"><?php echo htmlspecialchars($row['nama_mobil']); ?></td>
                        <td class="py-3 px-4">Rp. <?php echo number_format($row['harga_mobil'], 0, ',', '.'); ?></td>
                        <td class="py-3 px-4 text-center">
                            <a href="edit_mobil.php?id=<?php echo $row['id_mobil']; ?>" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded text-sm">
                                Edit
                            </a>
                            <a href="delete_mobil.php?id=<?php echo $row['id_mobil']; ?>" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus mobil ini?')">
                                Hapus
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center py-5">Belum ada data mobil. Silakan tambahkan mobil baru.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php 
// Panggil footer
include 'admin_footer.php'; 
?>