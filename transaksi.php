<?php
session_start();
require_once 'db_connection.php';

// PENJAGA KEAMANAN HALAMAN
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// 1. TANGKAP DATA DARI URL & SESSION
// Pastikan semua parameter dari detail_mobil.php ada
if (!isset($_GET['id_mobil'], $_GET['tanggal_penyewaan'], $_GET['durasi_penyewaan'])) {
    die("Data pesanan tidak lengkap.");
}

$id_mobil = $_GET['id_mobil'];
$tanggal_sewa_raw = $_GET['tanggal_penyewaan'];
$durasi = (int)$_GET['durasi_penyewaan'];
// Cek apakah checkbox 'dengan_supir' dicentang atau tidak
$dengan_supir_checked = isset($_GET['dengan_supir']) && $_GET['dengan_supir'] == '1';

// Ambil data user yang sedang login dari session
$id_user = $_SESSION['user_id'];
$nama_user = $_SESSION['nama_lengkap'];
$email_user = $_SESSION['email'];


// 2. AMBIL DETAIL HARGA MOBIL DARI DATABASE
$query_mobil = "SELECT nama_mobil, harga_mobil, supir, gambar1 FROM mobil WHERE id_mobil = ?";
$stmt = $conn->prepare($query_mobil);
$stmt->bind_param("i", $id_mobil);
$stmt->execute();
$result_mobil = $stmt->get_result();
if ($result_mobil->num_rows > 0) {
    $mobil = $result_mobil->fetch_assoc();
} else {
    die("Mobil tidak ditemukan.");
}


// 3. LAKUKAN PERHITUNGAN HARGA FINAL DI SERVER (LEBIH AMAN)
$subtotal = $mobil['harga_mobil'] * $durasi;
$biaya_supir = $dengan_supir_checked ? ($mobil['supir'] * $durasi) : 0; // Biaya supir dikali durasi
$biaya_admin = 5000; // Biaya admin tetap

$total_harga_final = $subtotal + $biaya_supir + $biaya_admin;

// Format tanggal agar lebih mudah dibaca
$tanggal_sewa_formatted = date('d F Y', strtotime($tanggal_sewa_raw));

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Proses Pembayaran | ManggaDua Transport</title>
    <link rel="stylesheet" href="./assets/css/tailwind.css" />
    <link rel="stylesheet" href="./assets/css/input.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
      integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer" />
    <style>
      /* BUTTON ACTIVE BANK PEMBAYARAN */
      .bank-pembayaran-button-active {
        border: 2px solid #f97316;
      }
    </style>
  </head>

  <body>
    <!-- NAVIGASI -->
    <nav class="h-[80px] w-full fixed top-0 left-0 z-[100] bg-white border-b">
      <div class="container h-full flex items-center justify-between">
        <!-- NAVIGASI KIRI -->
        <div>
          <a href="./index.php">
            <img src="./assets/images/logos/logoipsum-260.svg" class="object-cover w-[140px] h-auto" height="60" width="80" alt="260" />
          </a>
        </div>
        <!-- NAVIGASI KANAN -->
        <div class="hidden font-medium text-base text-gray-800 md:flex items-center gap-x-6">
          <a href="./index.php" class="pb-1.5 border-b-2 border-transparent hover:border-orange-500 hover:text-orange-500">Home</a>
              <a href="./daftar-paket.php" class="pb-1.5 border-b-2 border-transparent hover:border-orange-500 hover:text-orange-500">Daftar Paket</a>
              <a href="./artikel.php" class="pb-1.5 border-b-2 border-transparent hover:border-orange-500 hover:text-orange-500">Wisata</a>
              <a href="./faq.php" class="pb-1.5 border-b-2 border-transparent hover:border-orange-500 hover:text-orange-500">FAQ</a>

              <?php if (isset($_SESSION['user_id'])): ?>
                <a href="./profil.php" class="pb-1.5 border-b-2 border-transparent hover:border-orange-500 hover:text-orange-500">Profil</a>
                <a href="./logout.php" class="bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600">Logout</a>
              <?php else: ?>
                <a href="./login.php" class="font-semibold text-gray-800 hover:text-orange-500">Login</a>
                <a href="./register.php" class="bg-orange-500 text-white py-2 px-4 rounded-md hover:bg-orange-600">Daftar</a>
              <?php endif; ?>

              <a href="#" class="pb-1.5 border-b-2 border-transparent">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
              </a>
        </div>
        <!-- NAVIGASI MOBILE MUNCUL -->
        <div class="flex md:hidden">
          <button type="button" class="navigasi-mobile-open">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
          </button>
        </div>
      </div>
    </nav>
    <!-- NAVIGASI MOBILE -->
    <aside id="navigasi-mobile" class="block md:hidden h-full w-full bg-white fixed top-0 right-0 z-[120] transition-all duration-300 transform translate-x-[120%]">
      <div class="relative h-full w-full py-8 px-5">
        <div class="text-center mb-8">
          <a href="./index.php">
            <img src="./assets/images/logos/logoipsum-260.svg" class="object-cover w-[180px] h-auto mx-auto" height="60" width="80" alt="260" />
          </a>
        </div>
        <div>
          <h3 class="font-medium text-lg text-gray-900">Menu</h3>
          <div class="flex flex-col gap-y-3.5 font-medium text-base text-gray-800 mt-5">
            <a href="./index.php">Home</a>
            <a href="./daftar-paket.php">Daftar Paket</a>
            <a href="./artikel.php">Wisata</a>
            <a href="./faq.php">FAQ</a>
            <a href="./index.php"
              ><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
              </svg>
            </a>
          </div>
        </div>
        <!-- CLOSE NAVIGASI MOBILE -->
        <button type="button" class="navigasi-mobile-close h-10 w-10 absolute bottom-14 left-1/2 transform -translate-x-1/2 flex items-center justify-center bg-black text-white rounded-full">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </aside>
    <!-- MAIN -->
    <main class="pt-[120px] pb-[100px]">
      <div class="container max-w-screen-md mx-auto">
        <h1 class="font-bold text-2xl md:text-3xl text-gray-800 mb-8 text-center">Konfirmasi Pesanan Anda</h1>

        <div class="bg-white p-6 md:p-8 rounded-lg shadow-md border border-slate-200">
            <h2 class="font-bold text-xl text-gray-800 mb-4 border-b pb-2">Ringkasan Pesanan</h2>
            <div class="flex items-center space-x-4 mb-6">
                <img src="assets/images/images/<?php echo htmlspecialchars($mobil['gambar1']); ?>" alt="<?php echo htmlspecialchars($mobil['nama_mobil']); ?>" class="w-32 h-20 object-cover rounded-md">
                <div>
                    <h3 class="font-bold text-lg text-gray-900"><?php echo htmlspecialchars($mobil['nama_mobil']); ?></h3>
                    <p class="text-sm text-gray-600">Tanggal Sewa: <?php echo $tanggal_sewa_formatted; ?></p>
                    <p class="text-sm text-gray-600">Durasi: <?php echo $durasi; ?> Hari</p>
                </div>
            </div>

            <h2 class="font-bold text-xl text-gray-800 mb-4 border-b pb-2">Rincian Biaya</h2>
            <div class="space-y-2">
                <div class="flex justify-between text-gray-700">
                    <span>Harga Sewa (<?php echo $durasi; ?> Hari)</span>
                    <span>Rp. <?php echo number_format($subtotal, 0, ',', '.'); ?></span>
                </div>
                <div class="flex justify-between text-gray-700">
                    <span>Biaya Supir</span>
                    <span>Rp. <?php echo number_format($biaya_supir, 0, ',', '.'); ?></span>
                </div>
                <div class="flex justify-between text-gray-700">
                    <span>Biaya Admin</span>
                    <span>Rp. <?php echo number_format($biaya_admin, 0, ',', '.'); ?></span>
                </div>
                <hr class="my-2">
                <div class="flex justify-between font-bold text-gray-900 text-lg">
                    <span>Total Pembayaran</span>
                    <span>Rp. <?php echo number_format($total_harga_final, 0, ',', '.'); ?></span>
                </div>
            </div>
            
            <hr class="my-6">

            <h2 class="font-bold text-xl text-gray-800 mb-4 border-b pb-2">Data Diri Pemesan</h2>
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

            <div class="bg-blue-50 p-6 rounded-lg border border-blue-200">
                <h2 class="font-bold text-xl text-gray-800 mb-4">Petunjuk Pembayaran</h2>
                <div class="flex flex-col md:flex-row items-start gap-6">
                    <div class="w-full md:w-1/3 text-center">
                        <p class="font-semibold mb-2">Scan QRIS</p>
                        <img src="assets/images/images/kierkod.png" alt="QRIS Pembayaran" class="w-48 h-48 mx-auto border rounded-md p-1">
                    </div>
                    <div class="w-full md:w-2/3">
                        <p class="font-semibold mb-2">Atau Transfer Bank ke:</p>
                        <div class="space-y-2 text-gray-700">
                            <p><strong>Bank BCA:</strong> 123-456-7890 (a.n. ManggaDua Transport)</p>
                            <p><strong>Bank Mandiri:</strong> 098-765-4321 (a.n. ManggaDua Transport)</p>
                        </div>
                        <div class="mt-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-3 rounded-md text-sm">
                            <p><strong>Penting:</strong> Setelah melakukan pembayaran, silakan upload bukti transfer di halaman **Profil > Riwayat Transaksi** Anda untuk verifikasi.</p>
                        </div>
                    </div>
                </div>
            </div>

            <form action="proses_transaksi.php" method="POST" class="mt-8">
                <input type="hidden" name="id_mobil" value="<?php echo $id_mobil; ?>">
                <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
                <input type="hidden" name="tanggal_penyewaan" value="<?php echo $tanggal_sewa_raw; ?>">
                <input type="hidden" name="durasi_penyewaan" value="<?php echo $durasi; ?>">
                <input type="hidden" name="dengan_supir" value="<?php echo $dengan_supir_checked ? '1' : '0'; ?>">
                <input type="hidden" name="total_harga" value="<?php echo $total_harga_final; ?>">
                
                <p class="text-sm text-gray-600 mb-4">Dengan menekan tombol di bawah, Anda menyetujui semua rincian pesanan di atas.</p>

                <button type="submit" class="w-full inline-block py-3 md:py-4 px-8 rounded-md font-medium text-base md:text-xl text-white bg-green-500 hover:bg-green-600 transition duration-300 ease-in-out shadow-lg">
                    Konfirmasi & Lanjutkan Pembayaran
                </button>
            </form>
        </div>
      </div>
    </main>

    <!-- PEMBAYARAN FLOAT MOBILE -->
    <aside class="fixed bottom-0 left-0 flex md:hidden items-center z-50 h-[100px] bg-white w-full border-t border-gray-200">
      <div class="w-full flex items-center gap-x-6 px-5">
        <div class="grow">
          <p class="text-base text-gray-900">Total:</p>
          <p class="font-semibold text-xl text-gray-900">Rp. 2.005.000</p>
        </div>
        <button type="button" @click="onPayment" class="h-[46px] w-[120px] rounded-md flex-none font-medium text-lg text-white bg-blue-500">Bayar</button>
      </div>
    </aside>
    <!-- FOOTER -->

    <!-- MENGGUNAKAN FILE JQUERY CDN -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- JAVASCRIPT -->
    <script>
      $(document).ready(function () {
        // OPEN NAVIGASI MOBILE
        $(".navigasi-mobile-open").click(function () {
          $("#navigasi-mobile").removeClass("translate-x-[120%]");
        });
        // TUTUP NAVIGASI MOBILE
        $(".navigasi-mobile-close").click(function () {
          $("#navigasi-mobile").addClass("translate-x-[120%]");
        });

        // GANTI KATEGORI PAKET
        $(".bank-pembayaran-button").click(function () {
          $(this).siblings().removeClass("bank-pembayaran-button-active");
          $(this).addClass("bank-pembayaran-button-active");
        });
      });
    </script>
  </body>
</html>
<?php
// Tutup koneksi ke database
mysqli_close($conn);
?>