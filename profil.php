<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require_once 'db_connection.php';

// Ambil data user dari session
$id_user = $_SESSION['user_id'];
$nama_user = $_SESSION['nama_lengkap'];
$email_user = $_SESSION['email'];

// -- BLOK BARU DIMULAI DI SINI --

// Query untuk mengambil riwayat transaksi user yang sedang login
// Kita gabungkan (JOIN) tabel transaksi dan mobil untuk dapat nama mobilnya
$sql_transaksi = "SELECT t.*, m.nama_mobil, m.gambar1 
                  FROM transaksi t 
                  JOIN mobil m ON t.id_mobil = m.id_mobil 
                  WHERE t.id_user = ? 
                  ORDER BY t.waktu_booking DESC"; // Urutkan dari yang paling baru

$stmt_transaksi = $conn->prepare($sql_transaksi);
$stmt_transaksi->bind_param("i", $id_user);
$stmt_transaksi->execute();
$result_transaksi = $stmt_transaksi->get_result();

// -- BLOK BARU BERAKHIR DI SINI --

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profil Saya | ManggaDua Transport</title>
    <link rel="stylesheet" href="./assets/css/tailwind.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body class="bg-slate-50">
    <nav class="h-[80px] w-full fixed top-0 left-0 z-[100] bg-white border-b">
        <div class="container h-full flex items-center justify-between">
            <div>
                <a href="./index.php">
                    <img src="./assets/images/logos/logoipsum-260.svg" class="object-cover w-[140px] h-auto" alt="Logo" />
                </a>
            </div>
            <div class="hidden font-medium text-base text-gray-800 md:flex items-center gap-x-6">
                <a href="./index.php" class="pb-1.5 border-b-2 border-transparent hover:border-orange-500 hover:text-orange-500">Home</a>
                <a href="./daftar-paket.php" class="pb-1.5 border-b-2 border-transparent hover:border-orange-500 hover:text-orange-500">Daftar Paket</a>
                <a href="./artikel.php" class="pb-1.5 border-b-2 border-transparent hover:border-orange-500 hover:text-orange-500">Wisata</a>
                <a href="./faq.php" class="pb-1.5 border-b-2 border-transparent hover:border-orange-500 hover:text-orange-500">FAQ</a>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="./profil.php" class="pb-1.5 border-b-2 border-orange-500 text-orange-500">Profil</a>
                    <a href="./logout.php" class="bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600">Logout</a>
                <?php else: ?>
                    <a href="./login.php" class="font-semibold text-gray-800 hover:text-orange-500">Login</a>
                    <a href="./register.php" class="bg-orange-500 text-white py-2 px-4 rounded-md hover:bg-orange-600">Daftar</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <main class="pt-[120px] pb-[100px]">
        <div class="container">
            <h1 class="font-bold text-2xl md:text-3xl text-gray-800 mb-2">Profil Saya</h1>
            <p class="text-gray-600 mb-8">Lihat detail akun dan riwayat transaksimu di sini.</p>

            <div class="bg-white p-6 rounded-lg shadow-md border border-slate-200">
                <h2 class="font-bold text-xl text-gray-800 mb-4">Informasi Akun</h2>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-500">Nama Lengkap</p>
                        <p class="font-semibold text-gray-800"><?php echo htmlspecialchars($nama_user); ?></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="font-semibold text-gray-800"><?php echo htmlspecialchars($email_user); ?></p>
                    </div>
                </div>

                <hr class="my-6">

                <h2 class="font-bold text-xl text-gray-800 mb-4 border-b pb-2">Riwayat Transaksi Saya</h2>
                <div class="space-y-4">

                  <?php if ($result_transaksi->num_rows > 0): ?>
                    <?php while($transaksi = $result_transaksi->fetch_assoc()): ?>
                      <div class="flex flex-col md:flex-row items-start md:items-center space-y-3 md:space-y-0 md:space-x-4 bg-white p-4 rounded-lg border border-slate-200">
                        <img src="assets/images/images/<?php echo htmlspecialchars($transaksi['gambar1']); ?>" alt="<?php echo htmlspecialchars($transaksi['nama_mobil']); ?>" class="w-full md:w-32 h-24 object-cover rounded-md">
                        
                        <div class="grow">
                            <h3 class="font-bold text-lg text-gray-900"><?php echo htmlspecialchars($transaksi['nama_mobil']); ?></h3>
                            <p class="text-sm text-gray-600">ID Pesanan: #<?php echo $transaksi['id_transaksi']; ?></p>
                            <p class="text-sm text-gray-600">Tanggal Sewa: <?php echo date('d M Y', strtotime($transaksi['tanggal_penyewaan'])); ?></p>
                            <p class="font-bold text-lg text-gray-800 mt-2">Rp. <?php echo number_format($transaksi['total_harga'], 0, ',', '.'); ?></p>
                        </div>

                        <div class="w-full md:w-auto text-left md:text-right">
                            <?php
                                // Logika untuk warna status
                                $status = $transaksi['status_pembayaran'];
                                $warna_status = 'bg-yellow-100 text-yellow-800'; // Default untuk 'menunggu'
                                if ($status == 'lunas') { $warna_status = 'bg-green-100 text-green-800'; }
                                elseif ($status == 'batal') { $warna_status = 'bg-red-100 text-red-800'; }
                            ?>
                            <span class="text-xs font-medium inline-block mb-3 px-2.5 py-0.5 rounded <?php echo $warna_status; ?>"><?php echo ucfirst($status); ?></span>

                            <?php if ($status == 'menunggu' && empty($transaksi['bukti_pembayaran'])): ?>
                                <form action="proses_upload_bukti.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id_transaksi" value="<?php echo $transaksi['id_transaksi']; ?>">
                                    
                                    <div class="flex flex-col items-start md:items-end">
                                        
                                        <input type="file" name="bukti_pembayaran" 
                                              id="file_input_<?php echo $transaksi['id_transaksi']; ?>" 
                                              onchange="previewImage(event, 'image_preview_<?php echo $transaksi['id_transaksi']; ?>', 'preview_container_<?php echo $transaksi['id_transaksi']; ?>')" 
                                              class="text-sm border rounded-lg w-full mb-2" required>
                                        
                                        <div id="preview_container_<?php echo $transaksi['id_transaksi']; ?>" class="hidden w-full items-center gap-2 mb-2">
                                            <img id="image_preview_<?php echo $transaksi['id_transaksi']; ?>" src="#" alt="Preview" class="h-16 w-16 object-cover rounded border">
                                            <button type="button" 
                                                    onclick="cancelPreview('file_input_<?php echo $transaksi['id_transaksi']; ?>', 'image_preview_<?php echo $transaksi['id_transaksi']; ?>', 'preview_container_<?php echo $transaksi['id_transaksi']; ?>')"
                                                    class="text-xs bg-gray-200 text-gray-700 py-1 px-2 rounded hover:bg-gray-300">Batal</button>
                                        </div>

                                        <button type="submit" class="bg-blue-500 text-white text-sm font-bold py-1 px-3 rounded hover:bg-blue-600">Upload</button>
                                    </div>
                                </form>

                            <?php 
                            // Jika bukti sudah ada, tampilkan pesan
                            elseif (!empty($transaksi['bukti_pembayaran'])): 
                            ?>
                              <div class="mt-2">
                                <p class="text-sm text-green-600 font-semibold">✓ Bukti sudah diupload.</p>
                                <p class="text-xs text-gray-500">Menunggu verifikasi dari admin.</p>
                              </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endwhile; ?>
                  <?php else: ?>
                    <div class="text-center text-gray-500 py-8">
                      <p>Kamu belum memiliki riwayat transaksi.</p>
                      <a href="daftar-paket.php" class="mt-4 inline-block bg-orange-500 text-white py-2 px-5 rounded-md hover:bg-orange-600">Mulai Sewa Sekarang</a>
                    </div>
                  <?php endif; ?>

                </div>
            </div>
        </div>
    </main>
    
    <script>
      function previewImage(event, previewId, containerId) {
          // Ambil elemen container dan image preview
          const previewContainer = document.getElementById(containerId);
          const imagePreview = document.getElementById(previewId);
          
          // Ambil file yang dipilih user
          const file = event.target.files[0];
          
          // Buat file reader
          const reader = new FileReader();
          
          reader.onload = function(e) {
              // Tampilkan container preview
              previewContainer.classList.remove('hidden');
              previewContainer.classList.add('flex');
              
              // Set sumber gambar ke data URL dari file yang dibaca
              imagePreview.src = e.target.result;
          }
          
          // Baca file sebagai Data URL
          if (file) {
              reader.readAsDataURL(file);
          }
      }

      function cancelPreview(inputId, previewId, containerId) {
          // Ambil elemen-elemen terkait
          const fileInput = document.getElementById(inputId);
          const previewContainer = document.getElementById(containerId);
          const imagePreview = document.getElementById(previewId);

          // Sembunyikan kembali container preview
          previewContainer.classList.add('hidden');
          previewContainer.classList.remove('flex');

          // Hapus sumber gambar
          imagePreview.src = "#";

          // Reset nilai dari input file (ini yang paling penting)
          fileInput.value = "";
      }
    </script>



</body>
</html>