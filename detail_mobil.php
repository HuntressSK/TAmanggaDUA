<?php
session_start(); // Wajib untuk cek status login
require_once 'db_connection.php'; // Sambungkan ke database

// Cek apakah parameter id ada di URL
if (!isset($_GET['id_mobil'])) { // Kita ubah dari 'id' menjadi 'id_mobil' agar konsisten
    die("Error: Parameter id_mobil tidak ditemukan.");
}

$id_mobil = $_GET['id_mobil'];

// AMANKAN QUERY DENGAN PREPARED STATEMENT
$query = "SELECT * FROM mobil WHERE id_mobil = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_mobil); // 'i' berarti tipenya integer
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("Mobil tidak ditemukan.");
}
// JANGAN tutup koneksi di sini agar bisa dipakai di bagian lain jika perlu
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Mobil | ManggaDua Transport</title>
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
  </head>
  <body>
    <!-- awal header -->
    <header class="">
      <div>
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
                <a href="./index.php" class="text-orange-500">Home</a>
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
      </div>
    </header>
    <!-- akhir header -->

    <!-- Awal main -->
    <main>
        <div id="content" class="content">
            <!-- Awal detail produk -->
            <!-- Detail Produk Section -->
<section class="py-8 mt-14 bg-white md:py-16 antialiased">
    <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
        <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">
        <div class="shrink-0 max-w-full lg:max-w-full mx-auto">
            <!-- Gambar utama -->
            <img id="mainImage" class="rounded-xl w-full max-w-[900px] h-[450px] object-cover" src="assets/images/images/<?php echo $row['gambar1']; ?>" alt="gambar1" />
            <!-- Galeri gambar -->
            <div class="grid grid-cols-4 gap-4 mt-4">
                <?php if (!empty($row['gambar1'])): ?>
                <a href="#" onclick="changeMainImage(event, 'assets/images/images/<?php echo $row['gambar1']; ?>')">
                    <img class="w-full h-auto object-cover max-w-[96px] max-h-[86px]" src="assets/images/images/<?php echo $row['gambar1']; ?>" alt="gambar1" />
                </a>
                <?php endif; ?>
                
                <?php if (!empty($row['gambar2'])): ?>
                <a href="#" onclick="changeMainImage(event, 'assets/images/images/<?php echo $row['gambar2']; ?>')">
                    <img class="w-full h-auto object-cover max-w-[96px] max-h-[86px]" src="assets/images/images/<?php echo $row['gambar2']; ?>" alt="gambar2" />
                </a>
                <?php endif; ?>

                <?php if (!empty($row['gambar3'])): ?>
                <a href="#" onclick="changeMainImage(event, 'assets/images/images/<?php echo $row['gambar3']; ?>')">
                    <img class="w-full h-auto object-cover max-w-[96px] max-h-[86px]" src="assets/images/images/<?php echo $row['gambar3']; ?>" alt="gambar3" />
                </a>
                <?php endif; ?>

                <?php if (!empty($row['gambar4'])): ?>
                <a href="#" onclick="changeMainImage(event, 'assets/images/images/<?php echo $row['gambar4']; ?>')">
                    <img class="w-full h-auto object-cover max-w-[96px] max-h-[86px]" src="assets/images/images/<?php echo $row['gambar4']; ?>" alt="gambar4" />
                </a>
                <?php endif; ?>
            </div>
        </div>


            <div class="mt-6 sm:mt-8 lg:mt-0 h-fit">
<form action="transaksi.php" method="GET" class="border-2 rounded-xl">
    <div class="sm:items-center sm:gap-4 md:ml-12">
        <h1 class="text-xl mt-7 font-medium text-gray-900 sm:text-3xl"><?php echo $row['nama_mobil']; ?></h1>
        <p class="text-2xl my-3 font-bold text-gray-900 sm:text-3xl">Rp <?php echo number_format($row['harga_mobil'], 2); ?><span class="text-xl font-light"> Per Hari</span></p>
    </div>
    <div class="mt-6 md:my-7 md:gap-4 items-center justify-center flex flex-wrap">
        <div class="relative max-w-sm">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                </svg>
            </div>
            <input
                id="datepicker-actions"
                name="tanggal_penyewaan"
                datepicker
                datepicker-buttons
                datepicker-autoselect-today
                type="text"
                class="border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-4 focus:outline-none focus:ring-orange-300 focus:border-orange-300 block w-full ps-10 py-5"
                placeholder="Select date" 
                required />
        </div>

        <i class="fa-solid text-3xl text-gray-400 fa-arrow-right"></i>

        <div class="">
            <label for="durasi_penyewaan"  class="block text-sm font-medium text-gray-900 sr-only">Durasi</label>
            <select id="durasi_penyewaan" name="durasi_penyewaan" class="border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-4 focus:outline-none focus:ring-orange-300 focus:border-orange-300 block w-full px-32 py-5" required>
                <option value="" disabled selected hidden>Durasi</option>
                <option value="1">1 Hari</option>
                <option value="2">2 Hari</option>
                <option value="3">3 Hari</option>
                <option value="4">4 Hari</option>
            </select>
        </div>
    </div>

    <!-- Checkbox untuk pilihan dengan supir -->
    <div class="md:ml-14 flex items-center mb-7">
        <input type="checkbox" id="dengan_supir" name="dengan_supir" value="1" class="form-checkbox h-5 w-5 text-orange-500" />
        <label for="dengan_supir" class="ml-2 text-sm text-gray-900">Dengan Supir (+Rp.400,000)</label>
    </div>

      <!-- Hidden input untuk id_mobil -->
    <input type="hidden" name="id_mobil" value="<?php echo $row['id_mobil']; ?>">

    <!-- Tombol sewa -->
    <div class="mb-7 text-center">
        <?php if (isset($_SESSION['user_id'])): ?>
          <button type="submit" name="submit" class="rounded-xl border bg-orange-500 hover:bg-orange-400 text-xl text-white py-5 px-44">
            Sewa Sekarang
          </button>
        <?php else: ?>
          <div class="text-center bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded-lg">
            <p>Silakan <a href="login.php" class="font-bold underline">login</a> atau <a href="register.php" class="font-bold underline">daftar</a> terlebih dahulu untuk melanjutkan penyewaan.</p>
          </div>
        <?php endif; ?>
    </div>

    <!-- Informasi tambahan -->
    <hr class="border-t border-gray-300 font-semibold my-4 mx-12" />
    <div class="text-center mb-7">
        <h1 class="text-xl font-light text-gray-500">Belum Termasuk BBM</h1>
    </div>
</form>



                <!-- Whatsapp Chat Link -->
                <div class="mt-7 flex justify-center">
                    <a href="https://wa.me/yourwhatsappnumber" class="text-center px-40 rounded-xl py-3.5 bg-green-500 text-white hover:bg-green-400 flex items-center justify-center">
                        <i class="fa-brands fa-whatsapp text-4xl"></i>
                        <span class="text-xl pl-2">Chat WhatsApp</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Informasi tambahan -->
        <div class="flex gap-x-14">
            <div class="flex items-center">
                <i class="text-gray-500 text-2xl fa-solid fa-user"></i>
               
                   <span class="text-gray-500 text-lg ml-3">4 Orang</span>
               </div>
               <div class="flex items-center">
                   <i class="text-gray-500 text-2xl fa-solid fa-gas-pump"></i>
                   <span class="text-gray-500 text-lg ml-3">Pertalite</span>
               </div>
               <div class="flex items-center">
                   <i class="text-gray-500 text-2xl fa-solid fa-car"></i>
                   <span class="text-gray-500 text-lg ml-3">MPV</span>
               </div>
               <div class="flex items-center">
                   <img class="w-6" src="./assets/images/images//transmission-99bdf81676100ec67af1ab7690fa8f896298657e0474944201a54f8564ce4caf.svg" alt="" />
                   <span class="text-gray-500 text-lg ml-3">Manual & Matic</span>
               </div>
           </div>

           <!-- Deskripsi mobil -->
           <div class="flex flex-col gap-y-5 mt-14">
               <h1 class="font-semibold text-3xl text-left">Deskripsi Mobil</h1>
               <div class="mx-3 font-light text-base md:text-xl text-gray-400 text-left">
                   <?php if (isset($row['deskripsi_p1'])) : ?>
                       <p class="mb-5"><?php echo $row['deskripsi_p1']; ?></p>
                   <?php endif; ?>

                   <?php if (isset($row['deskripsi_p2'])) : ?>
                       <p class="my-5"><?php echo $row['deskripsi_p2']; ?></p>
                   <?php endif; ?>

                   <?php if (isset($row['deskripsi_p3'])) : ?>
                       <p class="my-5"><?php echo $row['deskripsi_p3']; ?></p>
                   <?php endif; ?>

                   <?php if (isset($row['deskripsi_p4'])) : ?>
                       <p class="my-5"><?php echo $row['deskripsi_p4']; ?></p>
                   <?php endif; ?>
               </div>
           </div>
           <!-- Akhir deskripsi mobil -->
       </div>
   </section>
   <!-- Akhir detail produk -->

            <!-- Akhir detail produk -->

            <!-- Script untuk mengubah gambar utama -->
            <script>
                function changeMainImage(event, imageUrl) {
                    event.preventDefault();
                    document.getElementById("mainImage").src = imageUrl;
                }
            </script>
        </div>
    </main>
    <!-- Akhir main -->


    <!-- awal foooter -->
    <!-- FOOTER -->
    <footer class="bg-white">
      <!-- FOOTER PERTAMA -->
      <div class="py-12 md:py-12 lg:py-14 border-y border-slate-200">
        <div class="container flex flex-wrap md:flex-nowrap items-start justify-between gap-x-[120px]">
          <!-- FOOTER PERTAMA KIRI -->
          <div class="w-full md:w-auto mb-6 md:mb-0">
            <h2 class="font-semibold text-base md:text-base lg:text-lg text-[#20202C]">ManggaDua Transport</h2>
            <div class="flex flex-col gap-y-3 text-sm md:text-sm lg:text-base text-gray-700 mt-2 md:mt-4">
              <a href="./index.php" rel="noreferrer noopener" class="hover:text-orange-600">Tentang Kami</a>
              <a href="./daftar-paket.php" rel="noreferrer noopener" class="hover:text-orange-600">Daftar Paket</a>
              <a href="./artikel.php" rel="noreferrer noopener" class="hover:text-orange-600">Wisata</a>
              <a href="./faq.php" rel="noreferrer noopener" class="hover:text-orange-600">FAQ</a>
            </div>
          </div>
          <!-- FOOTER PERTAMA TENGAH -->
          <div class="w-full md:w-auto mb-6 md:mb-0">
            <h3 class="font-semibold text-base md:text-base lg:text-lg text-[#20202C]">PERTANYAAN?</h3>
            <div class="flex flex-col gap-y-4 text-base md:text-base lg:text-lg mt-2 md:mt-4">
              <a href="mailto:tanya@traave.com" class="flex items-center gap-x-2.5 text-gray-800 hover:text-orange-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                </svg>
                <span class="inline-block -mt-px text-sm md:text-sm lg:text-base">tanya@manggaduatransport.com</span>
              </a>
              <a href="tel:08123456789" class="flex items-center gap-x-2.5 text-gray-800 hover:text-orange-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                </svg>
                <span class="inline-block -mt-px text-sm md:text-sm lg:text-base">08123456789</span>
              </a>
            </div>
          </div>
          <!-- FOOTER PERTAMA KANAN -->
          <div class="w-full md:w-[300px]">
            <div class="mb-6 md:mb-12">
              <h3 class="font-semibold text-base md:text-base lg:text-lg text-[#20202C]">PEMBAYARAN</h3>
              <!-- FOOTER PEMBAYARAN ICON -->
              <div class="w-full flex flex-wrap md:flex-nowrap gap-1 md:gap-2.5 text-sm text-gray-500 mt-2 md:mt-4">
                <div class="h-[36px] w-3/12 flex items-center justify-center border border-slate-200 rounded">
                  <img src="./assets/images/logos/logoipsum-259.svg" class="object-cover w-[80%] h-auto" height="60" width="80" alt="259" />
                </div>
                <div class="h-[36px] w-3/12 flex items-center justify-center border border-slate-200 rounded">
                  <img src="./assets/images/logos/logoipsum-260.svg" class="object-cover w-[80%] h-auto" height="60" width="80" alt="260" />
                </div>
                <div class="h-[36px] w-3/12 flex items-center justify-center border border-slate-200 rounded">
                  <img src="./assets/images/logos/logoipsum-261.svg" class="object-cover w-[80%] h-auto" height="60" width="80" alt="261" />
                </div>
                <div class="h-[36px] w-3/12 flex items-center justify-center border border-slate-200 rounded">
                  <img src="./assets/images/logos/logoipsum-262.svg" class="object-cover w-[80%] h-auto" height="60" width="80" alt="262" />
                </div>
              </div>
            </div>
            <div>
              <h3 class="font-semibold text-base md:text-base lg:text-lg text-[#20202C] uppercase mb-5 md:mb-0">PASANG APP ManggaDua Transport</h3>
              <div class="flex flex-wrap md:flex-nowrap gap-x-1 md:gap-x-3 gap-y-5 mt-2 md:mt-4">
                <div class="w-full md:w-1/2">
                  <img src="./assets/images/logos/logoipsum-263.svg" class="w-full h-[50px]" height="50" width="150" alt="263" />
                </div>
                <div class="w-full md:w-1/2">
                  <img src="./assets/images/logos/logoipsum-264.svg" class="w-full h-[50px]" height="50" width="150" alt="264" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- FOOTER: KEDUA -->
      <div class="py-5">
        <div class="container flex flex-wrap md:flex-nowrap justify-between items-center">
          <div class="w-full md:w-auto flex items-center justify-between md:justify-start md:gap-x-10 lg:gap-x-14">
            <!-- LOGO SOCIAL MEDIA -->
            <div class="w-full md:w-auto flex justify-center md:justify-start items-center gap-x-3">
              <a href="https://www.facebook.com/" target="_blank" rel="noreferrer noopener" aria-label="Facebook" class="h-[40px] w-[40px] flex items-center justify-center text-slate-600 hover:text-orange-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook h-6 w-6" viewBox="0 0 16 16">
                  <path
                    d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                </svg>
              </a>
              <a href="https://twitter.com/" target="_blank" rel="noreferrer noopener" aria-label="Twitter" class="h-[40px] w-[40px] flex items-center justify-center text-slate-600 hover:text-orange-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter h-6 w-6" viewBox="0 0 16 16">
                  <path
                    d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334q.002-.211-.006-.422A6.7 6.7 0 0 0 16 3.542a6.7 6.7 0 0 1-1.889.518 3.3 3.3 0 0 0 1.447-1.817 6.5 6.5 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.32 9.32 0 0 1-6.767-3.429 3.29 3.29 0 0 0 1.018 4.382A3.3 3.3 0 0 1 .64 6.575v.045a3.29 3.29 0 0 0 2.632 3.218 3.2 3.2 0 0 1-.865.115 3 3 0 0 1-.614-.057 3.28 3.28 0 0 0 3.067 2.277A6.6 6.6 0 0 1 .78 13.58a6 6 0 0 1-.78-.045A9.34 9.34 0 0 0 5.026 15" />
                </svg>
              </a>
              <a href="https://www.instagram.com/" target="_blank" rel="noreferrer noopener" aria-label="Instagram" class="h-[40px] w-[40px] flex items-center justify-center text-slate-600 hover:text-orange-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram h-6 w-6" viewBox="0 0 16 16">
                  <path
                    d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
                </svg>
              </a>
            </div>
          </div>
          <div class="w-full md:w-auto mt-5 md:mt-0">
            <!-- COPYRIGHT FOOTER -->
            <h4 class="font-medium text-sm text-[#20202C] text-center">© 2024 <strong>ManggaDua Transport</strong> Semua hak dilindungi undang-undang.</h4>
          </div>
        </div>
      </div>
    </footer>
    <!-- akhir footer -->

    <!-- cdn flowbite -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
  </body>
</html>
