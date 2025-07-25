<?php 
// Definisikan judul halaman spesifik di sini
$page_title = 'Manajemen Transaksi';

// Panggil header
include 'admin_header.php'; 

// Koneksi ke database (perhatikan path ../ karena kita ada di dalam folder /admin)
require_once '../db_connection.php';

// Query untuk mengambil SEMUA transaksi dan menggabungkannya dengan data user & mobil
$sql = "SELECT t.id_transaksi, t.waktu_booking, t.total_harga, t.status_pembayaran, t.bukti_pembayaran, u.nama_lengkap, u.no_hp, m.nama_mobil
        FROM transaksi t
        JOIN users u ON t.id_user = u.id_user
        JOIN mobil m ON t.id_mobil = m.id_mobil
        ORDER BY t.waktu_booking DESC";

$result = mysqli_query($conn, $sql);
?>

<h1 class="text-2xl font-bold mb-6 text-gray-800">Manajemen Transaksi</h1>
        
<div class="bg-white shadow-md rounded-lg overflow-x-auto">
    <table class="min-w-full bg-white">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="w-1/6 text-left py-3 px-4 uppercase font-semibold text-sm">ID Pesanan</th>
                <th class="w-1/6 text-left py-3 px-4 uppercase font-semibold text-sm">Pelanggan</th>
                <th class="w-1/6 text-left py-3 px-4 uppercase font-semibold text-sm">No. Telepon</th>
                <th class="w-2/6 text-left py-3 px-4 uppercase font-semibold text-sm">Mobil</th>
                <th class="w-1/6 text-left py-3 px-4 uppercase font-semibold text-sm">Total Harga</th>
                <th class="w-1/6 text-left py-3 px-4 uppercase font-semibold text-sm">Bukti Bayar</th>
                <th class="w-1/6 text-left py-3 px-4 uppercase font-semibold text-sm">Status</th>
                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-4">#<?php echo $row['id_transaksi']; ?></td>
                        <td class="py-3 px-4"><?php echo htmlspecialchars($row['nama_lengkap']); ?></td>
                        <td class="py-3 px-4">
                            <a href="https://wa.me/62<?php echo substr(htmlspecialchars($row['no_hp']), 1); ?>" target="_blank" class="text-green-600 hover:underline">
                                <?php echo htmlspecialchars($row['no_hp']); ?>
                            </a>
                        </td>
                        <td class="py-3 px-4"><?php echo htmlspecialchars($row['nama_mobil']); ?></td>
                        <td class="py-3 px-4">Rp. <?php echo number_format($row['total_harga'], 0, ',', '.'); ?></td>
                        <td class="py-3 px-4">
                            <?php if (!empty($row['bukti_pembayaran'])): ?>
                                <a href="../assets/images/bukti_pembayaran/<?php echo htmlspecialchars($row['bukti_pembayaran']); ?>" 
                                target="_blank" 
                                class="text-blue-500 hover:underline text-sm font-semibold">
                                    Lihat Bukti
                                </a>
                            <?php else: ?>
                                <span class="text-gray-400 text-sm">Belum ada</span>
                            <?php endif; ?>
                        </td>

                        <td class="py-3 px-4">
                            <?php
                                $status = $row['status_pembayaran'];
                                $warna_status = 'bg-yellow-200 text-yellow-800';
                                if ($status == 'lunas') { $warna_status = 'bg-green-200 text-green-800'; }
                                elseif ($status == 'batal') { $warna_status = 'bg-red-200 text-red-800'; }
                            ?>
                            <span class="text-xs font-semibold me-2 px-2.5 py-1 rounded-full <?php echo $warna_status; ?>"><?php echo ucfirst($status); ?></span>
                        </td>

                        <td class="py-3 px-4">
                            <form action="update_status.php" method="POST" class="flex items-center">
                                <input type="hidden" name="id_transaksi" value="<?php echo $row['id_transaksi']; ?>">
                                <select name="status_baru" class="text-sm rounded-lg border-gray-300">
                                    <option value="menunggu" <?php if($status == 'menunggu') echo 'selected'; ?>>Menunggu</option>
                                    <option value="lunas" <?php if($status == 'lunas') echo 'selected'; ?>>Lunas</option>
                                    <option value="batal" <?php if($status == 'batal') echo 'selected'; ?>>Batal</option>
                                </select>
                                <button type="submit" class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-sm">
                                    Update
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center py-5">Belum ada transaksi yang masuk.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php 
// Panggil footer
include 'admin_footer.php'; 
?>